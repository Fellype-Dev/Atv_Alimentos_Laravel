@extends('layouts.app')

@section('content')
<div class="container py-4" style="min-height: 80vh;">
    <div class="card shadow-lg" style="border: none; background-color: #202030;">
        <div class="card-header py-3" style="background-color: #1C77C3; border: none;">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h5 mb-0 fw-bold text-white">
                    <i class="bi bi-basket2 me-2"></i>Gestão de Alimentos
                </h2>
                
                <div class="d-flex align-items-center gap-2">
                    <form method="GET" action="{{ route('alimentos.index') }}" class="d-flex align-items-center">
                        <div class="form-check form-switch me-2">
                            <input class="form-check-input" type="checkbox" name="validade_proxima" id="validade_proxima" 
                                {{ request()->has('validade_proxima') ? 'checked' : '' }}>
                            <label class="form-check-label text-white" for="validade_proxima">Vencimento Próximo</label>
                        </div>
                        <button type="submit" class="btn btn-sm" style="background-color: #004F2D; color: white;">
                            <i class="bi bi-funnel"></i> Filtrar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body" style="background-color: #202030;">
            @if(session('sucesso'))
            <div class="alert alert-success alert-dismissible fade show" style="background-color: #004F2D; border: none; color: white;" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('sucesso') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
            @endif

            <div class="d-flex justify-content-between mb-4">
                <div class="d-flex align-items-center">
                    <span class="badge rounded-pill me-2" style="background-color: #A99F96; color: #202030;">
                        Total: {{ $alimentos->count() }}
                    </span>
                    @if(request()->has('validade_proxima'))
                    <span class="badge rounded-pill" style="background-color: #F02D3A; color: white;">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>Vencendo
                    </span>
                    @endif
                </div>
                
                <a href="{{ route('alimentos.create') }}" class="btn rounded-pill" style="background-color: #F02D3A; color: white;">
                    <i class="bi bi-plus-lg me-1"></i> Novo Item
                </a>
            </div>

            @if($alimentos->isEmpty())
            <div class="text-center py-5" style="color: #A99F96;">
                <i class="bi bi-basket" style="font-size: 3rem;"></i>
                <p class="mt-3">Sua despensa está vazia</p>
                <a href="{{ route('alimentos.create') }}" class="btn mt-3" style="background-color: #1C77C3; color: white;">
                    Adicionar primeiro item
                </a>
            </div>
            @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="color: white;">
                    <thead style="background-color: #1C77C3;">
                        <tr>
                            <th class="ps-4">Item</th>
                            <th>Categoria</th>
                            <th class="text-center">Quant.</th>
                            <th class="text-center">Validade</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alimentos as $alimento)
                        <tr style="border-left: 4px solid 
                            @if($alimento->quantidade < 5) #F02D3A
                            @elseif($alimento->validade && \Carbon\Carbon::parse($alimento->validade)->isBefore(now()->addDays(7))) #A99F96
                            @else #004F2D
                            @endif">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div style="width: 36px; height: 36px; background-color: #1C77C3; color: white;" 
                                         class="rounded-circle d-flex align-items-center justify-content-center me-3">
                                        <i class="bi bi-{{ $alimento->categoria == 'Frutas' ? 'apple' : 
                                                          ($alimento->categoria == 'Legumes' ? 'carrot' : 
                                                          ($alimento->categoria == 'Carnes' ? 'egg-fried' : 'cup-straw')) }}"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-medium">{{ $alimento->nome }}</p>
                                        <small style="color: #A99F96;">Adicionado em {{ $alimento->created_at->format('d/m/Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge rounded-pill py-1 px-3" 
                                      style="background-color: #1C77C3; color: white;">
                                    {{ $alimento->categoria }}
                                </span>
                            </td>
                            <td class="text-center fw-bold">
                                {{ $alimento->quantidade }}
                                @if($alimento->quantidade < 5)
                                <i class="bi bi-exclamation-triangle-fill ms-1" style="color: #F02D3A;"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($alimento->validade)
                                    <span style="@if(\Carbon\Carbon::parse($alimento->validade)->isBefore(now())) color: #F02D3A; @endif">
                                        {{ \Carbon\Carbon::parse($alimento->validade)->format('d/m/Y') }}
                                    </span>
                                    @if(\Carbon\Carbon::parse($alimento->validade)->isBefore(now()->addDays(7)))
                                    <i class="bi bi-exclamation-triangle-fill ms-1" style="color: #A99F96;"></i>
                                    @endif
                                @else
                                    <span style="color: #A99F96;">-</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('alimentos.edit', $alimento) }}" 
                                       class="btn btn-sm rounded-circle d-flex align-items-center justify-content-center" 
                                       style="width: 32px; height: 32px; background-color: #1C77C3; color: white;"
                                       data-bs-toggle="tooltip" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('alimentos.destroy', $alimento) }}" method="POST" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm rounded-circle d-flex align-items-center justify-content-center" 
                                                style="width: 32px; height: 32px; background-color: #F02D3A; color: white;"
                                                data-bs-toggle="tooltip" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection