<div id="schedule-view" class="border-2 border-primary m-2 hidden">
    <div class="flex flex-row p-4">
        <div class="flex-1">
            <div class="overflow-y-scroll">
                @foreach ($transactionData as $trad)
                    <div class="card w-11/12 m-2 bg-primary text-primary-content">
                        <div class="card-body">
                            <h2 class="card-title">{{ $trad->members->member_name }}</h2>
                            <p>PACKAGE: {{ $trad->TransactionDetails->packages->package_name }}</p>
                            <p>QTY: {{ $trad->TransactionDetails->quantity }} </p>
                            <p>OUTLET: {{ $trad->outlets->outlet_name }}</p>
                            <p>CASHIER {{ $trad->user->name }}</p>
                            <div class="justify-end card-actions">
                                <p class="hidden">{{ $trad->id }}</p>
                                <button class="btn reportSchedule">Report</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex-1">
            <div id="month" class="bg-primary text-primary-content text-center p-4">
                <div class="flex flex-row items-center">
                    {{-- <div class="flex-none">
                        <p class="font-bold">Previous</p>
                    </div> --}}

                    <div class="flex-1">
                        <h2 class="text-2xl font-medium">{{ now()->monthName }}</h2>
                        <p class="text-xl font-light">{{ now()->format('d') }} - {{ now()->dayName }}</p>
                    </div>
                    {{-- <div class="flex-none">
                        <p class="font-bold">Next</p>
                    </div> --}}
                </div>
            </div>

            <div id="weekday">
                <div class="flex flex-row text-center text-primary-content font-bold bg-green-300">
                    <div class="mx-5 my-2">
                        <div class="rounded-full bg-primary p-5 w-16">
                            <p>Su</p>
                        </div>
                    </div>

                    <div class="mx-5 my-2">
                        <div class="rounded-full bg-primary p-5 w-16">
                            <p>Mo</p>
                        </div>
                    </div>

                    <div class="mx-5 my-2">
                        <div class="rounded-full bg-primary p-5 w-16">
                            <p>Tu</p>
                        </div>
                    </div>

                    <div class="mx-5 my-2">
                        <div class="rounded-full bg-primary p-5 w-16">
                            <p>We</p>
                        </div>
                    </div>

                    <div class="mx-5 my-2">
                        <div class="rounded-full bg-primary p-5 w-16">
                            <p>Th</p>
                        </div>
                    </div>

                    <div class="mx-5 my-2">
                        <div class="rounded-full bg-primary p-5 w-16">
                            <p>Fr</p>
                        </div>
                    </div>

                    <div class="mx-5 my-2">
                        <div class="rounded-full bg-primary p-5 w-16">
                            <p>Sa</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-row flex-wrap text-center text-primary-content font-bold" id="days">
                @for ($i = 1; $i <= now()->daysInMonth; $i++)
                    @if ($i == now()->day)
                        <div class="mx-5 my-2">
                            <div class="rounded-full bg-primary p-5 w-16">
                                <p>{{ $i }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="mx-5 my-2">
                        <div class="rounded-full bg-green-300 p-5 w-16 hover:bg-green-400 cursor-pointer"
                            onclick="this.style.backgroundColor = ''">{{ $i }}</div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
