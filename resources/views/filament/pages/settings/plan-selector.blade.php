<x-filament-panels::page>

    <div class="mb-6">
        <x-filament::section>
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold">
                        Plano: {{ \Filament\Facades\Filament::getTenant()->plan->name }}
                    </h2>

                    <p class="text-sm text-gray-500">Sua assinatura renova em:
                        <strong>
                            {{ now()->addDays(30)->format('d/m/Y') }}
                        </strong>
                    </p>
                </div>

                <x-filament::badge color="success">
                    Ativo
                </x-filament::badge>
            </div>
        </x-filament::section>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($this->getPlans() as $plan)
            @php $isCurrent = $plan->id === $this->getCurrentPlanId(); @endphp

            <div
                class="w-full flex flex-col p-6 mx-auto max-w-lg text-center text-gray-900 bg-white rounded-lg border {{ $isCurrent ? 'border-primary-500 shadow-xl ring-2 ring-primary-500' : 'border-gray-100 shadow' }} dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">

                @if($isCurrent)
                    <span class="text-primary-600 font-bold uppercase text-sm mb-4">Plano Atual</span>
                @endif

                <h3 class="mb-4 text-2xl font-semibold">{{ $plan->name }}</h3>
                <div class="flex justify-center items-baseline my-8">
                    <span class="mr-2 text-5xl font-extrabold">R$ {{ number_format($plan->price, 2, ',', '.') }}</span>
                    <span class="text-gray-500">/mês</span>
                </div>

                <ul role="list" class="mb-8 space-y-4 text-left">
                    @foreach($plan->features as $feature)
                        <li class="flex items-center space-x-3">
                            <x-heroicon-o-check class="flex-shrink-0 w-5 h-5 text-green-500" />
                            <span>
                                @if($feature->type === 'limit')
                                    Até <strong>{{ $feature->pivot->value }}</strong> {{ $feature->name }}
                                @else
                                    {{ $feature->name }}
                                @endif
                            </span>
                        </li>
                    @endforeach
                </ul>

                @if(!$isCurrent)
                    <x-filament::button wire:click="selectPlan({{ $plan->id }})" size="lg">
                        Escolher Plano
                    </x-filament::button>
                @else
                    <x-filament::button color="gray" disabled size="lg">
                        Plano Ativo
                    </x-filament::button>
                @endif

                @if($plan->id != 1 && $plan->id == Filament\Facades\Filament::getTenant()->plan_id)
                    <div class="mt-4">
                        {{ $this->cancelarAssinaturaAction }}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</x-filament-panels::page>