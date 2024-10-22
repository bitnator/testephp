@extends('template')
@section('content')
    <div class="container py-3 mb-3">
        <h1 class="text-center mb-3">Listagem de usuários</h1>

        @if (isset($users[0]))
            <table id="users" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Data de Nascimento</th>
                        <th>Telefone</th>
                        <th>Opções</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->cpf }}</td>
                            <td>{{ $user->email }}</td>
                            <td><?php
                            $temp = explode('-', $user->birth_date);
                            echo $temp[2] . '/' . $temp[1] . '/' . $temp[0];
                            ?></td>
                            <td>{{ $user->phone }}</td>
                            <td>
                                <a href="{{ route('editScreen', $user->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                <a href="{{ route('delete', $user->id) }}" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="jumbotron bg-secondary bg-gradient">
                <p class="lead text-light text-center">Nenhum usuário cadastrado.</p>
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $('#users').DataTable({
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.11.3/i18n/pt_br.json"
            }
        })
    </script>
@endsection
