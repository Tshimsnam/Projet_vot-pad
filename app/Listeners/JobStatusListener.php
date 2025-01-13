<?php

namespace App\Listeners;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class JobStatusListener
{
    /**
     * Handle the event when the job is processed successfully.
     *
     * @param  JobProcessed  $event
     * @return void
     */
    public function handleJobProcessed(JobProcessed $event)
    {
        $data = $event->job->payload()['data']['command'];
        Log::info('Job processed data:', ['data' => $data]);

        // Désérialiser les données
        $unserializedData = unserialize($data);

        // Vérifiez si le désérialisation a réussi
        if ($unserializedData && is_object($unserializedData)) {
            $phaseId = $unserializedData->getPhaseId();
            Cache::increment("dispatch_{$phaseId}_success");

        } else {
            Log::error('Failed to unserialize data:', ['data' => $data]);
        }

    }

    /**
     * Handle the event when the job fails.
     *
     * @param  JobFailed  $event
     * @return void
     */
    public function handleJobFailed(JobFailed $event)
    {
        $data = $event->job->payload()['data']['command'];
        Log::info('Job processed data:', ['data' => $data]);

        // Désérialiser les données
        $unserializedData = unserialize($data);

        // Vérifiez si le désérialisation a réussi
        if ($unserializedData && is_object($unserializedData)) {
            $phaseId = $unserializedData->getPhaseId();
            Cache::increment("dispatch_{$phaseId}_failure");

        } else {
            Log::error('Failed to unserialize data:', ['data' => $data]);
        }
    }
}
