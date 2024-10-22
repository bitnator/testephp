@extends('template')
@section('content')
    <div class="container py-3 mb-3">
        <h1 class="text-center mb-3">Cadastro de usuário</h1>

        @if (count($errors))
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="contactForm" action="{{ route('store') }}" method="POST">
            @csrf
            <div class="form-floating mb-3">
                <input class="form-control" id="nome" name="name" type="text" placeholder="Nome" />
                <label for="nome">Nome</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="cpf" name="cpf" type="text" placeholder="CPF" />
                <label for="cpf">CPF</label>
            </div>
            <div class="form-floating mb-3">
                {{-- tive que colocar o type do campo de e-mail como text para poder passar a validação para o backend --}}
                <input class="form-control" id="eMail" name="email" type="text" placeholder="E-mail" />
                <label for="eMail">E-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="date" name="birth_date" type="text"
                    placeholder="Data de nascimento" />
                <label for="date">Data de nascimento</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="phone" name="phone" type="text" placeholder="Telefone" />
                <label for="phone">Telefone</label>
            </div>
            <div class="form-floating mb-3">
                <input class="form-control" id="senha" name="password" type="password" placeholder="Senha" />
                <label for="senha">Senha</label>
            </div>
            <div class="d-grid">
                <button class="btn btn-primary btn-lg" id="submitButton" type="submit">Salvar usuário</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#date').mask('00/00/0000');
            $('#cpf').mask('000.000.000-00');
            $('#phone').mask('(00) 00000-0000');
        });
    </script>
@endsection
