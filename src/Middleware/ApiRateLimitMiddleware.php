<?php
namespace ijiolao\ratelimiter\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ApiRateLimitMiddleware
{
    protected $strategies;

    public function __construct()
    {
        $this->strategies = config('api-ratelimit.strategies');
    }

    public function handle(Request $request, Closure $next)
    {
        // Get user identifier this can be either the user ID or the IP address
        $userIdentifier = $request->user() ? $request->user()->id : $request->ip();

        // Get the endpoint being accessed
        $endpoint = $request->path();

        // Get the rate limit strategy and configuration from the configuration file
        $strategy = config('api-ratelimit.default_strategy');
        $strategyConfig = $this->strategies[$strategy];

        // Get the user's current usage
        $usageKey = "api-rate-limit:$userIdentifier:$endpoint";
        $currentUsage = Cache::get($usageKey, 0);

        // Check if the user is within the rate limit
        try {
            $isWithinLimit = $this->applyStrategy($strategy, $strategyConfig, $currentUsage);
        } catch (\InvalidArgumentException $e) {
            return response()->json(
                ['message' => $e->getMessage()],
                Response::HTTP_BAD_REQUEST
            );
        }

        if (!$isWithinLimit) {
            $this->logRateLimitExceeded($userIdentifier, $endpoint);
            return $this->createRateLimitResponse($strategyConfig['capacity'], $strategyConfig['time_window']);
        }

        // Update user's usage
        Cache::put($usageKey, $currentUsage + 1, now()->addSeconds($strategyConfig['time_window']));

        // Add rate limit headers to the response
        return $next($request)
            ->header('X-RateLimit-Limit', $strategyConfig['capacity'])
            ->header('X-RateLimit-Remaining', $strategyConfig['capacity'] - $currentUsage - 1)
            ->header('X-RateLimit-Reset', now()->addSeconds($strategyConfig['time_window'])->timestamp);
    }

    protected function applyStrategy($strategy, $strategyConfig, $currentUsage)
    {
        if (!isset($this->strategies[$strategy])) {
            throw new \InvalidArgumentException("Invalid rate limit strategy: $strategy");
        }

        return $this->strategies[$strategy]($strategyConfig, $currentUsage);
    }

    protected function createRateLimitResponse($capacity, $timeWindow)
    {
        return response()->json(
            ['message' => 'Rate limit exceeded'],
            Response::HTTP_TOO_MANY_REQUESTS
        )->header('X-RateLimit-Limit', $capacity)
         ->header('X-RateLimit-Remaining', 0)
         ->header('X-RateLimit-Reset', now()->addSeconds($timeWindow)->timestamp);
    }

    protected function logRateLimitExceeded($userIdentifier, $endpoint)
    {
        $message = "Rate limit exceeded for user: $userIdentifier, endpoint: $endpoint";
        Log::warning($message);
    }
}
