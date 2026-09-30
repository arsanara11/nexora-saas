<x-app-layout>

    <div
        class="relative isolate overflow-hidden rounded-[48px] border border-white/[0.045] bg-[#0B0D10] px-6 py-7 text-[#F5F5F2] shadow-[0_35px_90px_rgba(0,0,0,0.22)] sm:px-8 sm:py-8 lg:px-10 lg:py-9"
    >

        {{-- Ambient background --}}
        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">

            <div
                class="absolute -left-32 -top-40 h-[420px] w-[420px] rounded-full bg-[#8B7CFF]/[0.08] blur-[110px]"
            ></div>

            <div
                class="absolute right-[-120px] top-[18%] h-[360px] w-[360px] rounded-full bg-[#4E6BFF]/[0.05] blur-[100px]"
            ></div>

            <div
                class="absolute bottom-[-180px] left-[35%] h-[420px] w-[420px] rounded-full bg-[#8B7CFF]/[0.04] blur-[120px]"
            ></div>

            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(139,124,255,0.05),transparent_28%),radial-gradient(circle_at_bottom_right,rgba(77,105,255,0.035),transparent_30%)]"
            ></div>

        </div>


        <div class="relative z-10">


            {{-- ========================================================
                HEADER
            ========================================================= --}}

            <div
                class="relative flex flex-col gap-5 border-b border-white/[0.045] pb-7 lg:flex-row lg:items-end lg:justify-between"
            >

                <div>

                    <div class="flex items-center gap-3">

                        <span
                            class="inline-flex h-2 w-2 rounded-full bg-[#8B7CFF] shadow-[0_0_14px_rgba(139,124,255,0.7)]"
                        ></span>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-[#A99FFF]">
                            Activity
                        </p>

                    </div>


                    <h1 class="mt-3 text-3xl font-semibold tracking-[-0.03em] text-white">
                        Notifications
                    </h1>


                    <p class="mt-2 max-w-xl text-sm leading-6 text-[#8B919A]">
                        Stay updated with activity and important events in your workspace.
                    </p>

                </div>


                <div class="flex items-center gap-3">

                    <div
                        class="hidden rounded-full border border-white/[0.06] bg-white/[0.02] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.16em] text-[#707782] sm:block"
                    >
                        Activity workspace
                    </div>


                    {{-- Mark All As Read --}}
                    @if ($unreadCount > 0)

                        <form
                            method="POST"
                            action="{{ route('notifications.read-all') }}"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 rounded-2xl border border-white/[0.06] bg-white/[0.02] px-4 py-3 text-sm font-medium text-[#C2C7CF] shadow-[0_12px_30px_rgba(0,0,0,0.12)] transition duration-200 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20 hover:bg-white/[0.04] hover:text-white"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-[#A99FFF]"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5 13l4 4L19 7"
                                    />
                                </svg>

                                Mark all as read

                            </button>

                        </form>

                    @endif

                </div>

            </div>


            {{-- ========================================================
                SUMMARY
            ========================================================= --}}

            <div class="relative mt-6 grid gap-4 md:grid-cols-2">


                {{-- Total Notifications --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#8B7CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#8B7CFF]/[0.08] blur-2xl transition duration-300 group-hover:bg-[#8B7CFF]/[0.12]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Total Notifications
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($notifications->count()) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Recent system notifications.
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#8B7CFF]/15 bg-[#8B7CFF]/[0.07] text-[#A99FFF]"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 17H9m10-5a7 7 0 10-14 0c0 2.2-.7 3.7-1.5 5h17C19.7 15.7 19 14.2 19 12z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13.73 21a2 2 0 01-3.46 0"
                                />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Unread --}}
                <div
                    class="group relative overflow-hidden rounded-[26px] border border-white/[0.055] bg-[#12151A]/90 p-5 shadow-[0_18px_55px_rgba(0,0,0,0.16)] backdrop-blur-sm transition duration-300 hover:-translate-y-0.5 hover:border-[#6F8CFF]/20"
                >

                    <div
                        class="absolute right-[-30px] top-[-35px] h-28 w-28 rounded-full bg-[#6F8CFF]/[0.06] blur-2xl transition duration-300 group-hover:bg-[#6F8CFF]/[0.10]"
                    ></div>


                    <div class="relative flex items-start justify-between gap-4">

                        <div>

                            <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                                Unread
                            </p>

                            <p class="mt-3 text-3xl font-semibold tracking-tight text-white">
                                {{ number_format($unreadCount) }}
                            </p>

                            <p class="mt-2 text-xs text-[#666D78]">
                                Notifications waiting for review.
                            </p>

                        </div>


                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl border border-[#6F8CFF]/15 bg-[#6F8CFF]/[0.06] text-[#9EB6E8]"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <circle
                                    cx="12"
                                    cy="12"
                                    r="8.5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 7v5"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 16h.01"
                                />

                            </svg>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ========================================================
                NOTIFICATION DIRECTORY
            ========================================================= --}}

            <div
                class="relative mt-6 overflow-hidden rounded-[30px] border border-white/[0.055] bg-[#11151A]/95 shadow-[0_30px_80px_rgba(0,0,0,0.22)] backdrop-blur-xl"
            >

                {{-- Directory Header --}}
                <div
                    class="relative flex flex-col gap-4 border-b border-white/[0.045] px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-7"
                >

                    <div>

                        <p class="text-[10px] font-semibold uppercase tracking-[0.18em] text-[#707782]">
                            Activity directory
                        </p>

                        <h2 class="mt-2 text-base font-semibold text-white">
                            Recent Activity
                        </h2>

                        <p class="mt-1 text-xs text-[#666D78]">
                            Your latest system notifications.
                        </p>

                    </div>


                    <div
                        class="rounded-xl border border-white/[0.05] bg-white/[0.018] px-3 py-2 text-[10px] font-medium uppercase tracking-[0.14em] text-[#707782]"
                    >
                        {{ $unreadCount }} unread
                    </div>

                </div>


                @forelse ($notifications as $notification)

                    @php

                        $data = $notification->data ?? [];

                        $title = $data['title'] ?? 'System Notification';

                        $message = $data['message']
                            ?? $data['body']
                            ?? 'You have a new notification.';

                        $icon = $data['icon'] ?? '◈';

                        $type = $data['type'] ?? 'system';

                        $isUnread = is_null($notification->read_at);

                    @endphp


                    {{-- Notification Row --}}
                    <div
                        class="group relative border-b border-white/[0.035] px-6 py-5 transition duration-200 last:border-b-0 hover:bg-white/[0.018] sm:px-7
                        {{ $isUnread ? 'bg-[#121720]' : '' }}"
                    >

                        @if ($isUnread)

                            <div
                                class="absolute inset-y-0 left-0 w-[2px] bg-[#8B7CFF] shadow-[0_0_14px_rgba(139,124,255,0.45)]"
                            ></div>

                        @endif


                        <div class="flex items-start gap-4">


                            {{-- Icon --}}
                            <div
                                class="relative flex h-11 w-11 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-[#8B7CFF]/10 bg-[#171B22] text-sm text-[#A99FFF] transition duration-200 group-hover:border-[#8B7CFF]/25 group-hover:bg-[#8B7CFF]/[0.07]"
                            >

                                <span class="relative z-10">
                                    {{ $icon }}
                                </span>

                                <span
                                    class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(139,124,255,0.14),transparent_55%)]"
                                ></span>

                            </div>


                            {{-- Main Content --}}
                            <div class="min-w-0 flex-1">

                                <div
                                    class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between"
                                >

                                    <div class="min-w-0">

                                        <div class="flex items-center gap-2">

                                            <h3
                                                class="truncate text-sm font-medium text-[#F5F5F2]"
                                            >
                                                {{ $title }}
                                            </h3>


                                            @if ($isUnread)

                                                <span
                                                    class="h-2 w-2 shrink-0 rounded-full bg-[#8B7CFF] shadow-[0_0_8px_rgba(139,124,255,0.7)]"
                                                ></span>

                                            @endif

                                        </div>


                                        <p class="mt-1 text-sm leading-6 text-[#8B929E]">
                                            {{ $message }}
                                        </p>

                                    </div>


                                    <span
                                        class="shrink-0 text-[11px] text-[#626975]"
                                    >
                                        {{ $notification->created_at?->diffForHumans() }}
                                    </span>

                                </div>


                                <div class="mt-4 flex flex-wrap items-center gap-3">

                                    {{-- Type --}}
                                    <span
                                        class="inline-flex items-center rounded-full border border-white/[0.05] bg-white/[0.018] px-3 py-1.5 text-[10px] font-medium uppercase tracking-[0.12em] text-[#707782]"
                                    >
                                        {{ $type }}
                                    </span>


                                    {{-- Status / Action --}}
                                    @if ($isUnread)

                                        <form
                                            method="POST"
                                            action="{{ route('notifications.read', $notification->id) }}"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="inline-flex items-center gap-1.5 text-xs font-medium text-[#9C91FF] transition hover:text-white"
                                            >

                                                Mark as read

                                                <span>
                                                    →
                                                </span>

                                            </button>

                                        </form>

                                    @else

                                        <span
                                            class="inline-flex items-center gap-2 text-xs text-[#5F6671]"
                                        >

                                            <span class="h-1.5 w-1.5 rounded-full bg-[#505761]"></span>

                                            Read

                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    {{-- Empty State --}}
                    <div
                        class="flex min-h-[380px] flex-col items-center justify-center px-6 text-center sm:px-8"
                    >

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-[22px] border border-[#8B7CFF]/10 bg-[#171B22] text-[#A99FFF] shadow-[0_18px_45px_rgba(0,0,0,0.18)]"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-7 w-7"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 17H9m10-5a7 7 0 10-14 0c0 2.2-.7 3.7-1.5 5h17C19.7 15.7 19 14.2 19 12z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M13.73 21a2 2 0 01-3.46 0"
                                />
                            </svg>

                        </div>


                        <h3 class="mt-5 text-sm font-semibold text-white">
                            No notifications yet
                        </h3>


                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-[#707782]">
                            Important activity and system updates will appear here.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</x-app-layout>