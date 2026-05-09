<x-app-layout>
    <div class="flex flex-col gap-5">

        <span class="bg-blue-400/30 border-2 border-blue-400 px-5 py-3 rounded-lg"><b>Nota</b>: Afegir les variables al
            <i>.env</i> (<i>README.md</i>)</span>

        @if (count($exercises))
            {{-- Barra lateral de filtres --}}
            <aside
                class="flex flex-col gap-5 p-8 rounded-xl border border-zinc-400 bg-[#eee] lg:w-120 h-fit lg:sticky top-22">
                <div>
                    <h1 class="font-bold text-2xl tracking-wide mb-3">BODYPARTS</h1>
                    @if (count($bodyparts))
                        <select class="w-full border rounded border-zinc-400 px-3 py-1.5 cursor-pointer">
                            <option value="all" selected>all</option>
                            @foreach (collect($bodyparts)->sortBy('name') as $bodypart)
                                <option value="{{ $bodypart['name'] }}">{{ $bodypart['name'] }}</option>
                            @endforeach
                        </select>
                    @else
                        <span>No s'ha carregat correctament!</span>
                    @endif
                </div>
                <div>
                    <h1 class="font-bold text-2xl tracking-wide mb-3">EQUIPMENTS</h1>
                    @if (count($equipments))
                        <select class="w-full border rounded border-zinc-400 px-3 py-1.5 cursor-pointer">
                            <option value="all" selected>all</option>
                            @foreach (collect($equipments)->sortBy('name') as $equipment)
                                <option value="{{ $equipment['name'] }}">{{ $equipment['name'] }}</option>
                            @endforeach
                        </select>
                    @else
                        <span>No s'ha carregat correctament!</span>
                    @endif
                </div>
                <div>
                    <h1 class="font-bold text-2xl tracking-wide mb-3">MUSCLES</h1>
                    @if (count($muscles))
                        <select class="w-full border rounded border-zinc-400 px-3 py-1.5 cursor-pointer">
                            <option value="all" selected>all</option>
                            @foreach (collect($muscles)->sortBy('name') as $muscle)
                                <option value="{{ $muscle['name'] }}">{{ $muscle['name'] }}</option>
                            @endforeach
                        </select>
                    @else
                        <span>No s'ha carregat correctament!</span>
                    @endif
                </div>
            </aside>

            {{-- Llista músculs --}}
            <div class="flex flex-col gap-5">
                <h1 class="font-bold text-2xl tracking-wide">EXERCISES</h1>
                @if (count($exercises))
                    @foreach ($exercises as $e)
                        <div class="border border-zinc-400 bg-[#eee] rounded-xl px-7 py-5 flex flex-col gap-2">
                            <div class="flex justify-between mb-3">
                                <div class="flex gap-2 items-center">
                                    <h2 class="capitalize text-xl">{{ $e['name'] }}</h2>
                                    <div>
                                        @foreach ($e['targetMuscles'] as $tm)
                                            <span
                                                class="capitalize border border-zinc-400 px-2 py-1 rounded">{{ $tm }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <span class="text-sm text-zinc-500 font-mono">{{ $e['exerciseId'] }}</span>
                            </div>
                            <div class="flex gap-1 items-center">
                                <p>Parts del Cos:</p>
                                @foreach ($e['bodyParts'] as $bp)
                                    <span
                                        class="capitalize border border-zinc-400 px-2 py-1 rounded">{{ $bp }}</span>
                                @endforeach
                            </div>
                            <div class="flex gap-1 items-center">
                                <p>Equipaments:</p>
                                @foreach ($e['equipments'] as $eq)
                                    <span
                                        class="capitalize border border-zinc-400 px-2 py-1 rounded">{{ $eq }}</span>
                                @endforeach
                            </div>

                            <div class="flex gap-1 items-center">
                                <p>Músculs secondaris:</p>
                                @foreach ($e['secondaryMuscles'] as $sm)
                                    <span
                                        class="capitalize border border-zinc-400 px-2 py-1 rounded">{{ $sm }}</span>
                                @endforeach
                            </div>
                            <div class="grid grid-cols-1 2xl:grid-cols-3 gap-5">
                                <div class="flex flex-col gap-1 2xl:col-span-2">
                                    <h3 class="text-lg font-semibold">Instruccions:</h3>
                                    <ul class="pl-5 leading-7">
                                        @foreach ($e['instructions'] as $i)
                                            <li class="list-disc">{{ $i }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="flex justify-center 2xl:justify-end">
                                    <img src="{{ $e['gifUrl'] }}" alt=""
                                        class="border w-80 aspect-square border-zinc-400 rounded-xl">
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <span>No s'han carregat correctament!</span>
                @endif
            </div>
        @else
            <p>L'API principal no funciona!</p>

            @if (count($yuhonas))

                @php
                    $filtered = $yuhonas;

                    $levels = [];
                    $muscles = [];
                    $categories = [];
                    $forces = [];
                    $mechanics = [];
                    $equipments = [];

                    foreach ($yuhonas as $e) {
                        if (!in_array($e['level'], $levels, true)) {
                            array_push($levels, $e['level']);
                        }
                        foreach ($e['primaryMuscles'] as $pm) {
                            if (!in_array($pm, $muscles, true)) {
                                array_push($muscles, $pm);
                            }
                        }
                        foreach ($e['secondaryMuscles'] as $sm) {
                            if (!in_array($sm, $muscles, true)) {
                                array_push($muscles, $sm);
                            }
                        }
                        if (!in_array($e['category'], $categories, true)) {
                            array_push($categories, $e['category']);
                        }
                        if (!in_array($e['force'], $forces, true)) {
                            array_push($forces, $e['force']);
                        }
                        if (!in_array($e['mechanic'], $mechanics, true)) {
                            array_push($mechanics, $e['mechanic']);
                        }
                        if (!in_array($e['equipment'], $equipments, true)) {
                            array_push($equipments, $e['equipment']);
                        }
                    }
                @endphp

                <aside class="border border-zinc-400 rounded-xl p-5">
                    <form action="" class="flex flex-col gap-3">
                        <h2 class="text-xl font-medium">Filtres (no funcional)</h2>
                        <input type="text" name="" id="" placeholder="Exercise name...">
                        <div class="flex flex-wrap gap-5 items-center">
                            <div class="flex flex-col gap-2">
                                <label for="" class="text-sm text-zinc-500">Dificultat</label>
                                <select name="" id="">
                                    <option value="">Totes</option>
                                    @foreach ($levels as $l)
                                        <option value="">{{ $l }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="" class="text-sm text-zinc-500">Músculs</label>
                                <select name="" id="">
                                    <option value="">Tots</option>
                                    @foreach ($muscles as $m)
                                        <option value="">{{ $m }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="" class="text-sm text-zinc-500">Categoria</label>
                                <select name="" id="">
                                    <option value="">Totes</option>
                                    @foreach ($categories as $c)
                                        <option value="">{{ $c }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="" class="text-sm text-zinc-500">Force</label>
                                <select name="" id="">
                                    <option value="">Totes</option>
                                    @foreach ($forces as $f)
                                        <option value="">{{ $f }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="" class="text-sm text-zinc-500">Mechanic</label>
                                <select name="" id="">
                                    <option value="">Totes</option>
                                    @foreach ($mechanics as $m)
                                        <option value="">{{ $m }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label for="" class="text-sm text-zinc-500">Equipament</label>
                                <select name="" id="">
                                    <option value="">Tots</option>
                                    @foreach ($equipments as $e)
                                        <option value="">{{ $e }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button
                            class="mt-3 self-end border border-zinc-400 rounded px-5 py-1 hover:bg-zinc-200 transition cursor-pointer w-fit">Search</button>
                    </form>
                </aside>

                @foreach ($filtered as $e)
                    <div class="border border-zinc-400 bg-[#eee] rounded-xl px-7 py-5 flex flex-col gap-2">
                        <div class="flex justify-between mb-3">
                            <div>
                                <span class="text-xs text-zinc-500 capitalize">{{ $e['level'] }}</span>
                                <div class="flex gap-2 items-center">
                                    <h2 class="capitalize text-xl">{{ $e['name'] }}</h2>
                                    <div>
                                        @foreach ($e['primaryMuscles'] as $tm)
                                            <span
                                                class="capitalize border border-zinc-400 px-2 py-1 rounded">{{ $tm }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <span class="text-sm text-zinc-500 font-mono">{{ $e['id'] }}</span>
                        </div>

                        <div class="flex gap-1 items-center">
                            <p>Categoria:</p>
                            <span
                                class="capitalize border border-zinc-400 px-2 py-1 rounded">{{ $e['category'] }}</span>
                        </div>

                        <div class="flex gap-1 items-center">
                            <p>Force:</p>
                            <span
                                class="capitalize border border-zinc-400 px-2 py-1 rounded">{{ $e['force'] }}</span>
                        </div>

                        @if ($e['mechanic'])
                            <div class="flex gap-1 items-center">
                                <p>Mechanic:</p>
                                <span
                                    class="capitalize border border-zinc-400 px-2 py-1 rounded">{{ $e['mechanic'] }}</span>
                            </div>
                        @endif

                        @if ($e['equipment'])
                            <div class="flex gap-1 items-center">
                                <p>Equipament:</p>
                                <span
                                    class="capitalize border border-zinc-400 px-2 py-1 rounded">{{ $e['equipment'] }}</span>
                            </div>
                        @endif

                        @if (count($e['secondaryMuscles']))
                            <div class="flex gap-1 items-center">
                                <p>Músculs secondaris:</p>
                                <div class="flex gap-1 flex-wrap">
                                    @foreach ($e['secondaryMuscles'] as $sm)
                                        <span
                                            class="capitalize border border-zinc-400 px-2 py-1 rounded">{{ $sm }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="flex flex-col gap-5">
                            <div class="flex flex-col gap-1 flex-1">
                                <h3 class="text-lg font-semibold">Instruccions:</h3>
                                <ul class="pl-5 leading-7">
                                    @foreach ($e['instructions'] as $i)
                                        <li class="list-disc">{{ $i }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="flex flex-wrap justify-center gap-3">
                                @foreach ($e['images'] as $img)
                                    <img src="https://ik.imagekit.io/yuhonas/{{ $img }}"
                                        alt="{{ $img }}"
                                        class="border w-80 aspect-square border-zinc-400 rounded-xl object-cover object-center">
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>L'API secondaria no funciona!</p>
            @endif
        @endif
    </div>
</x-app-layout>
