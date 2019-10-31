<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NotifyController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Get all user's notifications
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetchnotifications()
    {

        $user =$this->user;
        $notifications = $user->notifications;

        $notifications->transform(function ($item, $key) {
            return [
                'id' => $item->id,
                'type' => $this->snakeCasedType($item->type),
                'data' => $item->data,
                'read_at' => $item->read_at,
                'created_at' => date('Y-m-d hh:m:s' ,strtotime($item->created_at)),
            ];
        });

        $res["data"] = $notifications;
        return response()->json($res, 200);

    }

    /**
     * Mark a notification as read
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function markread($id){
      $notification = DatabaseNotification::where('id', $id)->where('notifiable_id', $this->user->id)->first();

      if (! $notification) {
          return response()->json([
              'message' => "Notification item not found"
          ], 404);
      }

        $notification->markAsRead();

      return response()->json(["message" => "Notification item has been marked as read"]);
    }

    /**
     * Delete a notification item
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){
        $notification = DatabaseNotification::where('id', $id)->where('notifiable_id', $this->user->id)->first();

        if (! $notification) {
            return response()->json(['message' => 'Notification item not found'], 404);
        }

        try {
            $notification->delete();
            return response()->json(['message' => 'Notification item deleted']);
        }
        catch (\Exception $e) {
            Log::critical("Unable to delete Notification item, got error: {$e->getMessage()}");
            return  response()->json(['message' => 'An error was encountered.'], 500);
        }
    }

    /**
     * Snake case of the notification type
     * @param string $typ
     * @return string
     */
    private function snakeCasedType(string $typ)
    {
        $typ = str_replace("App\Notifications\\", '', $typ);

        return Str::snake($typ);
    }


}
