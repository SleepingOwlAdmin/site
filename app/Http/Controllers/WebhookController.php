<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function run(Request $request)
    {
        set_time_limit(300);

        $action = $request->header('X-GitHub-Event');
        $repository = $request->json('repository.full_name');

        $path = config("github.repositories.{$repository}.path", base_path('deployment'));
        $script = config("github.repositories.{$repository}.actions.{$action}");

        $output = null;
        $status = false;
        if ($script && is_dir($path) && file_exists($path.DIRECTORY_SEPARATOR.$script)) {
            exec("cd {$path} && ./{$script}", $output);
            $status = true;
        }

        return new JsonResponse([
            'status' => $status,
            'action' => $action,
            'output' => $output,
        ]);
    }
}