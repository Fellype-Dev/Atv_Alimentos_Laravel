Sistema de Gestão de Alimentos

📝 Descrição
Um sistema web desenvolvido em Laravel para gerenciamento de estoque de alimentos, com controle de validade e quantidades. Ideal para despensas domésticas, pequenos comércios ou qualquer pessoa que deseje organizar seus alimentos de forma eficiente.

🎨 Paleta de Cores
A aplicação utiliza uma paleta sofisticada e moderna:

#202030 (Fundo principal)

#A99F96 (Elementos secundários)

#1C77C3 (Destaques)

#004F2D (Ações positivas)

#F02D3A (Alertas)

✨ Funcionalidades Principais:

📋 Cadastro de alimentos com nome, quantidade, categoria e validade
🔍 Filtro inteligente por validade próxima
⚠️ Alertas visuais para estoque baixo e produtos perto do vencimento
✏️ Edição fácil dos itens cadastrados
🗑️ Exclusão segura com confirmação
📱 Design responsivo que funciona em qualquer dispositivo

🛠️ Tecnologias Utilizadas:

PHP 8+ com framework Laravel
Bootstrap 5 para estilos e componentes
Bootstrap Icons para ícones intuitivos
Carbon para manipulação de datas
MySQL para armazenamento de dados

🚀 Como Executar o Projeto:

Pré-requisitos:
PHP 8.0+
Composer
MySQL
Node.js (opcional para assets)

Instalação:

bash
git clone https://github.com/seu-usuario/foodstock-manager.git
cd foodstock-manager
composer install
cp .env.example .env
php artisan key:generate

Configuração do Banco:
Crie um banco MySQL
Configure no .env:

ini
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
Execução:

bash
php artisan migrate
php artisan serve
Acesse:
Abra no navegador: http://localhost:8000

