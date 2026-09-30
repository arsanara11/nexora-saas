<x-app-layout>
    <div class="mx-auto max-w-4xl space-y-6">

        {{-- Header --}}
        <div>
            <a
                href="{{ route('roles.index') }}"
                class="inline-flex items-center gap-2 text-sm text-[#8B919A] transition hover:text-[#F5F5F2]"
            >
                <svg
                    class="h-4 w-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 12H5"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m12 19-7-7 7-7"
                    />
                </svg>

                Back to Roles
            </a>

            <div class="mt-5">
                <p class="text-xs font-medium uppercase tracking-[0.2em] text-[#8B7CFF]">
                    Access Control
                </p>

                <h1 class="mt-2 text-2xl font-semibold tracking-tight text-[#F5F5F2]">
                    Edit Role
                </h1>

                <p class="mt-1 text-sm text-[#8B919A]">
                    Update role information and manage its permissions.
                </p>
            </div>
        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="rounded-xl border border-red-400/15 bg-red-400/5 px-4 py-4">
                <div class="flex items-start gap-3">

                    <div class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-red-400/10">
                        <svg
                            class="h-3.5 w-3.5 text-red-400"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12"
                            />
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-red-300">
                            Please check the following errors.
                        </p>

                        <ul class="mt-2 space-y-1 text-xs text-red-300/80">
                            @foreach ($errors->all() as $error)
                                <li>
                                    • {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        @endif


        {{-- Role Form --}}
        <form
            method="POST"
            action="{{ route('roles.update', $role) }}"
            class="space-y-6"
        >
            @csrf
            @method('PUT')


            {{-- Basic Information --}}
            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">
                    <h2 class="text-sm font-semibold text-[#F5F5F2]">
                        Role Information
                    </h2>

                    <p class="mt-1 text-xs text-[#8B919A]">
                        Update the name and description of this role.
                    </p>
                </div>


                <div class="space-y-5 px-6 py-6">

                    {{-- Name --}}
                    <div>
                        <label
                            for="name"
                            class="text-sm font-medium text-[#F5F5F2]"
                        >
                            Role Name
                        </label>

                        <input
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name', $role->name) }}"
                            required
                            class="mt-2 block w-full rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm text-[#F5F5F2] outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/20"
                        >
                    </div>


                    {{-- Description --}}
                    <div>
                        <label
                            for="description"
                            class="text-sm font-medium text-[#F5F5F2]"
                        >
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            class="mt-2 block w-full resize-none rounded-xl border border-[#242830] bg-[#0B0D10] px-4 py-3 text-sm leading-6 text-[#F5F5F2] outline-none transition placeholder:text-[#555B65] focus:border-[#8B7CFF]/50 focus:ring-1 focus:ring-[#8B7CFF]/20"
                        >{{ old('description', $role->description) }}</textarea>
                    </div>

                </div>

            </div>


            {{-- Permissions --}}
            @php
                $selectedPermissions = old(
                    'permissions',
                    $role->permissions->pluck('id')->toArray()
                );
            @endphp

            <div class="overflow-hidden rounded-2xl border border-[#242830] bg-[#12151A]">

                <div class="border-b border-[#242830] px-6 py-5">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <h2 class="text-sm font-semibold text-[#F5F5F2]">
                                Permissions
                            </h2>

                            <p class="mt-1 text-xs text-[#8B919A]">
                                Update which areas this role can access.
                            </p>
                        </div>

                        <span class="inline-flex w-fit items-center rounded-lg border border-[#8B7CFF]/15 bg-[#8B7CFF]/5 px-2.5 py-1 text-xs font-medium text-[#B8B0FF]">
                            {{ $permissions->count() }} available
                        </span>

                    </div>
                </div>


                <div class="grid gap-3 p-6 sm:grid-cols-2">

                    @foreach ($permissions as $permission)

                        <label
                            class="group flex cursor-pointer items-start gap-3 rounded-xl border border-[#242830] bg-[#0B0D10] p-4 transition hover:border-[#8B7CFF]/30 hover:bg-white/[0.015]"
                        >

                            <input
                                type="checkbox"
                                name="permissions[]"
                                value="{{ $permission->id }}"
                                @checked(in_array(
                                    $permission->id,
                                    $selectedPermissions
                                ))
                                class="mt-0.5 h-4 w-4 rounded border-[#3A3F48] bg-[#0B0D10] text-[#8B7CFF] focus:ring-[#8B7CFF]/30"
                            >

                            <div class="min-w-0">
                                <p class="text-sm font-medium text-[#F5F5F2]">
                                    {{ $permission->name }}
                                </p>

                                <p class="mt-1 text-xs leading-5 text-[#6F7680]">
                                    Access related features and actions.
                                </p>
                            </div>

                        </label>

                    @endforeach

                </div>

            </div>


            {{-- Protected Owner Notice --}}
            @if ($role->name === 'Owner')
                <div class="rounded-xl border border-amber-400/10 bg-amber-400/5 px-4 py-4">

                    <div class="flex items-start gap-3">

                        <div class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-amber-400/10">
                            <svg
                                class="h-3.5 w-3.5 text-amber-300"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <rect
                                    x="4"
                                    y="10"
                                    width="16"
                                    height="11"
                                    rx="2"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 10V7a4 4 0 0 1 8 0v3"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-amber-300">
                                Owner role
                            </p>

                            <p class="mt-1 text-xs leading-5 text-amber-300/70">
                                This role is protected and cannot be deleted.
                                Its permissions can still be managed.
                            </p>
                        </div>

                    </div>

                </div>
            @endif


            {{-- Actions --}}
            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('roles.index') }}"
                    class="inline-flex items-center justify-center rounded-xl border border-[#242830] bg-[#12151A] px-5 py-3 text-sm font-medium text-[#A4A9B1] transition hover:border-[#353A44] hover:text-[#F5F5F2]"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#F5F5F2] px-5 py-3 text-sm font-semibold text-[#0B0D10] transition hover:bg-white"
                >
                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 12.5 9.5 17 19 7"
                        />
                    </svg>

                    Save Changes
                </button>

            </div>

        </form>

    </div>
</x-app-layout>