<?php
namespace App\Repository;
use App\Models\User;
 use App\Repository\ConversationRepository;

class ConversationsRepository{

private $user;

public  function __construct(User $user, Message $message){
    $this->user=$user;
    $this->message=$message;
}
 public function getConversations(int $userId){

    return $this->user->newQuerry()
    ->select('name','id')
    ->where('id','!=', $userId)
    ->get();
 }

public function createMessage(string $content, int $from, int $to){

  return  $this->message->newQuerry()->create([
        'content'=>$content,
        'from'=>$from,
        'to'=>$to,
        'create_at'=> carbon:: now()

    ]);
}


}