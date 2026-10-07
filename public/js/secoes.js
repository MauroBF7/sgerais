document.addEventListener('DOMContentLoaded', function () {

    // Esconde todas as linhas de grupos inicialmente
    document.querySelectorAll('[class^="grupo"]').forEach(function(linha){
        linha.style.display='none';
    });

    // Delegação de evento:
    // funciona mesmo após DataTables reconstruir a tabela
    document.addEventListener('click', function(e){

        let botao = e.target.closest('.toggle-grupo');

        if(!botao){
            return;
        }

        let grupo = botao.dataset.grupo;

        let linhas =
            document.querySelectorAll('.'+grupo);

        let escondido =
            linhas[0].style.display==='none';

        linhas.forEach(function(linha){

            linha.style.display =
                escondido ? '' : 'none';

        });

        botao.innerText =
            escondido ? '▼' : '▶';

    });

});
