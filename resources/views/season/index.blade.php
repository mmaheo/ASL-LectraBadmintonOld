@extends('layout')

@section('title')
    Liste des utilisateurs
@stop

@section('content')

    <h1 class="text-center">Liste des saisons</h1>

    <hr>

    @if(count($seasons) > 0)

        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Nom</th>
                                    <th class="text-center">Actif</th>
                                    <th class="text-center">Modification</th>
                                    <th class="text-center">Editer</th>
                                    <th class="text-center">Supprimer</th>
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($seasons as $season)
                                    <tr>
                                        <td class="text-center">
                                            {{ $season->name }}
                                        </td>
                                        <td class="text-center">
                                            @if($season->hasActive('1'))
                                                <span class="fa fa-check-circle-o text-success" aria-hidden="true"></span>
                                            @else
                                                <span class="fa fa-times-circle-o text-danger"
                                                      aria-hidden="true"></span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($season->hasActive('1'))
                                                <span class="fa fa-check-circle-o text-success" aria-hidden="true"></span>
                                            @else
                                                <a href="{{ route('season.change_active_attribute', $season->id) }}" class="btn btn-primary">Devenir active</a>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('season.edit', $season->id) }}" class="btn btn-info dim">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('season.delete', $season->id) }}" class="btn btn-danger dim">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else

        <h2 class="text-center text-danger">Pas de saison</h2>

    @endif
@stop