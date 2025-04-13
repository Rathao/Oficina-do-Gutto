$(document).ready(function() {
    // Cadastro de Cliente
    $('#btnCadastrarCliente').click(function() {
        var nome_cliente = $('#nome_cliente').val();
        var cpf_cnpj_cliente = $('#cpf_cnpj_cliente').val();
        var telefone_cliente = $('#telefone_cliente').val();
        var email_cliente = $('#email_cliente').val();
        var endereco_cliente = $('#endereco_cliente').val();

        $.ajax({
            url: '../backend/cadastar_clientes.php',
            type: 'post',
            data: {
                nome_cliente: nome_cliente,
                cpf_cnpj_cliente: cpf_cnpj_cliente,
                telefone_cliente: telefone_cliente,
                email_cliente: email_cliente,
                endereco_cliente: endereco_cliente
            },
            success: function(response) {
                if (response.trim() === 'Cliente cadastrado com sucesso!') {
                    $('#modalCadastroCliente').modal('hide');
                    $('#nome_cliente').val('');
                    $('#cpf_cnpj_cliente').val('');
                    $('#telefone_cliente').val('');
                    $('#email_cliente').val('');
                    $('#endereco_cliente').val('');
                    alert('Cliente cadastrado com sucesso!');
                } else {
                    alert(response);
                }
            }
        });
    });

    // Cadastro de Veículo
    $('#btnCadastrarVeiculo').click(function() {
        var cliente_id = $('#cliente_id').val();
        var marca = $('#marca').val();
        var modelo = $('#modelo').val();
        var ano = $('#ano').val();
        var placa = $('#placa').val();
        var cor = $('#cor').val();

        $.ajax({
            url: '../../backend/cadastro_veiculos.php',
            type: 'POST',
            data: {
                cliente_id_veiculo: cliente_id,
                marca_veiculo: marca,
                modelo_veiculo: modelo,
                ano_veiculo: ano,
                placa_veiculo: placa,
                cor_veiculo: cor
            },
            success: function(response) {
                if (response.trim() === 'Veículo cadastrado com sucesso!') {
                    $('#modalCadastroVeiculo').modal('hide');
                    $('#cliente_id').val('');
                    $('#marca').val('');
                    $('#modelo').val('');
                    $('#ano').val('');
                    $('#placa').val('');
                    $('#cor').val('');
                    alert('Veículo cadastrado com sucesso!');
                } else {
                    alert(response);
                }
            }
        });
    });
});
const hamburger = document.querySelector('.hamburger');
const menuList = document.querySelector('.menu-list');

hamburger.addEventListener('click', () => {
    menuList.classList.toggle('open');
    hamburger.classList.toggle('open');
});

// Fechar o menu ao clicar em um item (opcional)
document.querySelectorAll('.menu-list a').forEach(item => {
    item.addEventListener('click', () => {
        menuList.classList.remove('open');
        hamburger.classList.remove('open');
    });
});