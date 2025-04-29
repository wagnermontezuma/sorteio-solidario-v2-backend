@extends('layouts.default')

@section('content')

    <h1 class="page-header">Grupo de Usuários</h1>

    <div class="row">
        <div class="col-6">

            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">{{ isset($role) ? 'Atualização de Grupo de Usuários' : 'Cadastro de Grupo de Usuários' }}</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>

                <div class="panel-body">
                    @if (isset($role))
                        {!! html()->form('POST', route('controle.roles.update', $role->id))->open() !!}
                    @else
                        {!! html()->form('POST', route('controle.roles.store'))->open() !!}
                    @endif
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nome:</strong>
                                {!! html()->text('name', $role->name ?? null)->class('form-control')->placeholder('Nome') !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Permissões:</strong>
                                <br />

                                <div id="accordion">
                                    @foreach ($catPermissions as $catPermission)
                                        <div class="card mb-3">
                                            <div class="card-header bg-light d-flex justify-content-between align-items-center" id="heading{{ $catPermission->id }}" style="cursor: pointer;" data-toggle="collapse" data-target="#collapse{{ $catPermission->id }}" aria-expanded="false" aria-controls="collapse{{ $catPermission->id }}">
                                                <div>
                                                    <span>{{ $catPermission->name }}</span>
                                                </div>
                                                <div>
                                                    <input type="checkbox" class="select-all-category ml-2" data-category="{{ $catPermission->id }}" id="select-all-category-{{ $catPermission->id }}">
                                                    <label for="select-all-category-{{ $catPermission->id }}" class="ml-1 mr-3 label-todos">Todos</label>
                                                    <i class="fa fa-chevron-down"></i>
                                                </div>
                                            </div>

                                            <div id="collapse{{ $catPermission->id }}" class="collapse" aria-labelledby="heading{{ $catPermission->id }}" data-parent="#accordion">
                                                <div class="card-body">
                                                    @foreach ($catPermission->permissions as $permission)
                                                        <div class="form-check">
                                                            {!! html()->checkbox('permission[]', isset($role) && in_array($permission->id, $rolePermissions), $permission->id)->class('form-check-input category-permission-' . $catPermission->id)->id("permission-{$permission->id}") !!}
                                                            {!! html()->label($permission->name, "permission-{$permission->id}")->class('form-check-label') !!}
                                                        </div>

                                                        @if (!$loop->last)
                                                            <hr>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            {!! html()->button('Salvar')->type('submit')->class('btn btn-sm btn-primary m-r-5') !!}
                            {!! html()->a(route('controle.roles.index'), 'Cancelar')->class('btn btn-sm btn-default') !!}
                        </div>
                    </div>
                    {!! html()->form()->close() !!}
                </div>

            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Adicionar evento para "Marcar todos" nas categorias
            document.querySelectorAll('.select-all-category').forEach(function (checkbox) {
                checkbox.addEventListener('click', function (event) {
                    // Previne que o clique no checkbox ative o evento do collapse
                    event.stopPropagation();
                });

                checkbox.addEventListener('change', function () {
                    const categoryId = this.getAttribute('data-category');
                    const permissions = document.querySelectorAll('.category-permission-' + categoryId);

                    permissions.forEach(function (permission) {
                        permission.checked = checkbox.checked;
                    });
                });
            });

            // Prevenir que o clique nos checkboxes individuais ative o evento do collapse
            document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
                checkbox.addEventListener('click', function (event) {
                    event.stopPropagation();
                });
            });

            // Prevenir que o clique no card ative o evento do collapse
            document.querySelectorAll('.label-todos').forEach(function (card) {
                card.addEventListener('click', function (event) {
                    event.stopPropagation();
                });
            });
        });
    </script>
@endsection
