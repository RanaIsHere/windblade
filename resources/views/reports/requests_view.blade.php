<div id="requests-view" class="border-2 border-primary m-2 hidden">
    <div class="flex flex-row p-4">
        <div class="flex-1">
            <div class="bg-primary rounded-l-xl px-4 py-3 text-primary-content">
                <p class="text-lg font-semibold">Users</p>
            </div>

            <div class="overflow-y-scroll px-2">
                @foreach (Auth::user()->where('outlet_id', Auth::user()->outlet_id)->get()->except(Auth::user()->id)
    as $user)
                    <div class="card w-full bg-primary text-primary-content my-4">
                        <div class="card-body">
                            <h2 class="card-title">{{ $user->username }}, {{ $user->roles }}</h2>
                            <p class="opacity-50">{{ $user->name }}</p>
                            <div class="justify-end card-actions">
                                <button class="btn">Start Messaging</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex-1">
            <div class="bg-primary text-primary-content rounded-r-xl px-4">
                <p class="text-lg font-semibold">Messaging: <span id="username-of-chat"></span></p>
                <p class="opacity-50 font-extralight">Last online: </p>
            </div>

            <div class="flex flex-col">
                <div id="chat-box" class="bg-gray-700 text-primary h-96 px-2 overflow-y-auto">
                    <p>> Welcome, {{ Auth::user()->username }}</p>

                    @foreach ($chatData as $chat)
                        <p>{{ $chat->user->username }}: {{ $chat->message }}</p>
                    @endforeach
                </div>

                <div id="message-box" class="bg-gray-900 text-primary-content p-2">
                    <form id="messageForm">
                        <div class="input-group">
                            <input type="text" class="input input-sm text-black input-bordered w-full"
                                placeholder="Request something..." id="chatInput">
                            <button type="submit" class="btn btn-sm btn-primary" id="sendChat">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
