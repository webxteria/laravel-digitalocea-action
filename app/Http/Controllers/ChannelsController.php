<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChannelRequest;
use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $channel = Channel::query();

        if ($request->has('type') &&  $request->type === 'active') {
            $channel->ActiveChannels();
        }

        if ($request->has('type') &&  $request->type === 'archived') {
            $channel->onlyTrashed();
        }

        return ChannelResource::collection(
            $channel
                ->with('users')
                ->paginate($request->input('per_page', 10))
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChannelRequest $request, Channel $channel)
    {
        return new ChannelResource(
            $channel->create($request->validated())
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return new ChannelResource($channel->load('users'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChannelRequest $request, Channel $channel)
    {
        $channel->update($request->validated());
        return $this->show($channel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        $channel->delete();
        return response()->noContent();
    }
}
