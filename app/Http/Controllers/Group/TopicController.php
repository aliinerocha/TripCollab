<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Topic;
use App\TopicMessage;
use App\Group;
use App\User;
use App\LikeTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Topic $topic, Group $group, User $user, TopicMessage $topicMessage)
    {
        $this->topic = $topic;
        $this->group = $group;
        $this->user = $user;
        $this->topicMessage = $topicMessage;
    }

    public function index($id)
    {
        $group = $this->group->findOrFail($id);
        $topics = Topic::where('group_id',$group->id)->orderBy('topics.created_at', 'desc')->get();
        $user = auth()->user(['id', 'name']);
        
        return view('Groups and Trips/Group/Topics/index', compact('group', 'topics', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $topic = new Topic();
        $topic->user_id = auth()->user()->id;
        $topic->group_id = $request->input('group_id');
        $topic->name = $request->name;
        $topic->description = $request->description;
        $topic->save();
        
        return redirect()->route('group.show', $topic->group_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = $this->topic->findOrFail($id);
        $group = $this->group->findOrFail($topic->group_id);
        $user = auth()->user(['id', 'name']);
        $topicMessages = TopicMessage::where('topic_id',$topic->id)->orderBy('topic_messages.created_at', 'desc')->get();
        
        return view('Groups and Trips/Group/Topics/show', compact('topic','user', 'topicMessages','group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $topicForm = $this->topic->findOrFail($id);
        $topic = $this->topic->findOrFail($id);
        $group = $this->group->findOrFail($topic->group_id);
        $user = auth()->user(['id', 'name']);
        $topicMessages = TopicMessage::where('topic_id',$topic->id)->orderBy('topic_messages.created_at', 'desc')->get();

        return view('Groups and Trips/Group/Topics/show', compact('topicForm','topic','user', 'topicMessages','group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $topic = \App\Topic::find($id);

        $topic->update($data);

        return redirect()->route('topic.show', $topic->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = $this->topic->find($id);
        $topic->topicMessages()->delete();
        $topic->likeTopics()->delete();
        $group_id = $topic->group->id;
        $topic->delete();

        return redirect()->route('topic.index', $group_id);
    }

    public function likeTopic($id)
    {       
        $topic = Topic::find($id);
        $user = auth()->user(['id', 'name']);
        $likeTopic = LikeTopic::where('topic_id', $topic->id)->where('user_id', $user->id)->first();

        if ($likeTopic == null){
            $likeTopic = new LikeTopic();
            $likeTopic->user_id = auth()->user()->id;
            $likeTopic->topic_id = $topic->id;
            $likeTopic->like_topic = 1;
            $likeTopic->save();
        } else {
            if ($likeTopic = LikeTopic::where('topic_id', $topic->id)->where('user_id', $user->id)->where('like_topic',1)->first())
            {
                $likeTopic->delete();
            } else {
                $dislikeTopic = LikeTopic::where('topic_id', $topic->id)->where('user_id', $user->id)->update(array('like_topic' => '1'));
            }
        }
        
        return redirect()->route('topic.show', $topic->id);
    }

    public function dislikeTopic($id)
    {       
        $topic = Topic::find($id);
        $user = auth()->user(['id', 'name']);
        $dislikeTopic = LikeTopic::where('topic_id', $topic->id)->where('user_id', $user->id)->first();

        if ($dislikeTopic == null)
        {
            $dislikeTopic = new LikeTopic();
            $dislikeTopic->user_id = auth()->user()->id;
            $dislikeTopic->topic_id = $topic->id;
            $dislikeTopic->like_topic = 0;
            $dislikeTopic->save();
        } else {
            if ($dislikeTopic = LikeTopic::where('topic_id', $topic->id)->where('user_id', $user->id)->where('like_topic',0)->first())
            {
                $dislikeTopic->delete();
            } else {
                $dislikeTopic = LikeTopic::where('topic_id', $topic->id)->where('user_id', $user->id)->update(array('like_topic' => '0'));
            }
        }

        return redirect()->route('topic.show', $topic->id);
    }
}
