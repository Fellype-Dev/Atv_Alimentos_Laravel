@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm" style="border: none; background-color: #202030;">
                <div class="card-header py-3 border-0" style="background-color: #1C77C3;">
                    <div class="d-flex align-items-center">
                        <div style="width: 40px; height: 40px; background-color: rgba(255,255,255,0.2);" 
                             class="rounded-circle d-flex align-items-center justify-content-center me-3">
                            <i class="bi bi-pencil text-white"></i>
                        </div>
                        <h2 class="h5 mb-0 text-white">Editar Alimento</h2>
                    </div>
                </div>

                <div class="card-body px-4 py-4" style="color: white;">
                    <form action="{{ route('alimentos.update', $alimento) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nome" class="form-label">Nome do Alimento</label>
                            <input type="text" class="form-control rounded-pill border-0 py-2 px-3" 
                                   id="nome" name="nome" value="{{ $alimento->nome }}" required
                                   style="background-color: #2a2a3a; color: white;">
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="number" class="form-control rounded-pill border-0 py-2 px-3" 
                                       id="quantidade" name="quantidade" min="1" value="{{ $alimento->quantidade }}" required
                                       style="background-color: #2a2a3a; color: white;">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="validade" class="form-label">Data de Validade</label>
                                <input type="date" class="form-control rounded-pill border-0 py-2 px-3" 
                                       id="validade" name="validade" value="{{ $alimento->validade }}"
                                       style="background-color: #2a2a3a; color: white;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select class="form-select rounded-pill border-0 py-2 px-3" 
                                    id="categoria" name="categoria" required style="background-color: #2a2a3a; color: white;">
                                <option value="Frutas" {{ $alimento->categoria == 'Frutas' ? 'selected' : '' }}>Frutas</option>
                                <option value="Legumes" {{ $alimento->categoria == 'Legumes' ? 'selected' : '' }}>Legumes</option>
                                <option value="Carnes" {{ $alimento->categoria == 'Carnes' ? 'selected' : '' }}>Carnes</option>
                                <option value="Laticínios" {{ $alimento->categoria == 'Laticínios' ? 'selected' : '' }}>Laticínios</option>
                                <option value="Grãos" {{ $alimento->categoria == 'Grãos' ? 'selected' : '' }}>Grãos</option>
                                <option value="Bebidas" {{ $alimento->categoria == 'Bebidas' ? 'selected' : '' }}>Bebidas</option>
                                <option value="Outros" {{ $alimento->categoria == 'Outros' ? 'selected' : '' }}>Outros</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('alimentos.index') }}" class="btn rounded-pill px-4" 
                               style="background-color: #A99F96; color: #202030;">
                                <i class="bi bi-arrow-left me-1"></i> Cancelar
                            </a>
                            <button type="submit" class="btn rounded-pill px-4 text-white" 
                                    style="background-color: #004F2D;">
                                <i class="bi bi-check-lg me-1"></i> Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection