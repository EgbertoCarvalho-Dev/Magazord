<?php
session_start();


if (isset($_SESSION['msg']) && $_SESSION['msg']) {
    unset($_SESSION['msg']);
    $msg = true;
} else {
    $msg = false;
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Magazord Teste</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-info">
    <div class="container-fluid">
        <div class="row d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="col-6">

                <div class="card shadow p-2">
                    <div class="card-header text-center">
                        <img src="https://github.com/magazord-plataforma/magazord-backend-test/raw/master/image/logo-magazord.png" />
                        <br>
                        <h4>Backend Test</h4>
                    </div>
                    <div class="card-body ">
                        <p class="fw-semibold text-center">
                            Para pesquisar, basta apenas digitar o nome da pessoa abaixo
                        </p>
                        <?php
                        if ($msg) {
                        ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Pronto!</strong> Salvo com sucesso.
                            </div>

                        <?php
                        }
                        ?>
                        <div class="row">
                            <div class="col-11">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Pesquisar">
                                </div>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                        <h6><i class="fa-solid fa-square-poll-vertical"></i> Resultado</h6>
                        <hr>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">CPF</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($pessoas) > 0) {
                                        foreach ($pessoas as $pessoa) {
                                    ?>
                                            <tr class="itemPessoa">
                                                <td scope="row"><?= $pessoa->id ?></td>
                                                <td><?= $pessoa->nome ?></td>
                                                <td><?= $pessoa->cpf ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-info" onclick="showPerson('<?= $pessoa->id ?>')"><i class="fas fa-eye"></i></button>
                                                    <button type="button" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="removerPessoa('<?= $pessoa->id ?>', this)"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="5" class="text-center">Sem registros salvo no banco de dados.</td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-success" onclick="$('#adicionarPessoa').modal('show');">Adicionar Pessoa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <form action="/api/adicionarPessoa" method="POST" enctype="multipart/form-data">
        <div class="modal fade" id="adicionarPessoa" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Adicionar Pessoa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4 h-100">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Informações Pessoais</h6>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nome</label>
                                            <input type="text" class="form-control" required name="nome" aria-describedby="helpId" placeholder="">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">CPF</label>
                                            <input type="text" class="form-control cpf" required name="cpf" aria-describedby="helpId" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <h6>Informações de Contato</h6>

                                <div class="row">
                                    <div class="col-12" id="campos">
                                        <div class="row">
                                            <div class="col-2">
                                                <div class="mb-3">
                                                    <label for="tipo1" class="form-label">Tipo</label>
                                                    <select class="form-select" name="contato[1][tipo]" id="tipo1">
                                                        <option selected value="email">Email</option>
                                                        <option value="tel">Telefone</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-9">
                                                <div class="mb-3">
                                                    <label for="descricao1" class="form-label">Descrição</label>
                                                    <input type="text" class="form-control" name="contato[1][descricao]" id="descricao1" aria-describedby="helpId" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-1 pt-4">
                                                <div class="mb-3 pt-2 text-center">
                                                    <button type="button" class="btn btn-secondary"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="button" class="btn btn-success" onclick="adicionarCampos();">Adicionar Campos</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="visualizarPessoa" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId"><span class="badge bg-info">Visualizar</span> <span id="idPessoa">#3</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="general">
                    <h6>Informações Pessoais</h6>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Nome</label>
                                <input type="text" class="form-control" disabled id="nome" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">CPF</label>
                                <input type="text" class="form-control" disabled id="CPF" aria-describedby="helpId" placeholder="">
                            </div>
                        </div>
                    </div>
                    <h6>Informações de Contato</h6>
                    <div class="row">
                        <div class="col-12">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Descrição</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyContact">

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-body" id="loadInfoDetail">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="spinner-border text-primary spinner-border-sm" role="status" style="width: 4rem; height: 4rem;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <script src="./assets/jquery.mask.js"></script>
    <script>
        $(document).ready(() => {
            $('.cpf').mask('000.000.000-00');
        })
        var fields = 1;

        function adicionarCampos() {
            fields++;
            $('#campos').append(`
                <div class="row newField">
                    <div class="col-2">
                        <div class="mb-3">
                            <label for="tipo${fields}" class="form-label">Tipo</label>
                            <select class="form-select" name="contato[${fields}][tipo]" id="tipo${fields}">
                                <option selected value="email">Email</option>
                                <option value="tel">Telefone</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="mb-3">
                            <label for="descricao${fields}" class="form-label">Descrição</label>
                            <input type="text" class="form-control" name="contato[${fields}][descricao]" id="descricao${fields}" aria-describedby="helpId" placeholder="">
                        </div>
                    </div>
                    <div class="col-1 pt-4">
                        <div class="mb-3 pt-2 text-center">
                            <button type="button" class="btn btn-danger" onclick="removeField(this)"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            
            `);
        }

        function removeField(btn) {
            $(btn).closest('.newField').remove();
        }

        function showPerson(id) {

            $('#idPessoa').html('#' + id);
            $.ajax({
                url: 'api/consultarPessoa',
                type: 'POST',
                data: {
                    id: id,
                },
                beforeSend: () => {
                    $('#general').hide();
                    $('#loadInfoDetail').show();
                    $('#visualizarPessoa').modal('show');
                },
                success: (data) => {
                    $('#bodyContact').empty();

                    if (data.contacts.length > 0) {
                        data.contacts.map((item, i) => {
                            let type = "";
                            if (item.type == 'email') {
                                type = '<span class="badge bg-primary">Email</span>';
                            } else {
                                type = '<span class="badge bg-info">Telefone</span>';
                            }
                            $('#bodyContact').append(`
                            <tr class="itemContact">
                                <td>${item.id}</td>
                                <td>${type}</td>
                                <td>${item.description}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removerContato('${item.id}', this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            `);
                        })
                    } else {
                        $('#bodyContact').html("<tr><td colspan='4' class='text-center'><h6 style='text-align:center;'>Nenhum contato cadastrado para esta pessoa</h6></td></tr>");
                    }
                    $('#nome').val(data.name);
                    $('#CPF').val(data.cpf);
                    $('#loadInfoDetail').fadeOut('fast', () => {
                        $('#general').fadeIn('fast');
                    })
                }
            })
        }

        function removerContato(id, btn) {
            $(btn).closest('.itemContact').remove();
            $.ajax({
                url: 'api/removerContato',
                type: 'POST',
                data: {
                    id: id
                },
                success: (data) => {
                    if (data.status != true) {
                        alert('Falha ao excluir este contato, tente novamente mais tarde.');
                        $('#visualizarPessoa').modal('hide');
                    }
                }
            })
        }

        function removerPessoa(id, btn) {
            $(btn).closest('.itemPessoa').remove();
            $.ajax({
                url: 'api/removerPessoa',
                type: 'POST',
                data: {
                    id: id
                },
                success: (data) => {
                    if (data.status != true) {
                        alert('Falha ao excluir esta pessoa, tente novamente mais tarde.');
                    }
                }
            })
        }
    </script>
</body>

</html>