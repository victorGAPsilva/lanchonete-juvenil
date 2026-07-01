# Lanchonete Juvenil

Site de pedidos online para a marca Mercadinho Juvenil, com foco em experiência mobile-first, identidade visual premium e estrutura MVC em PHP 8+.

## Estrutura

```text
/app
	/Controllers
	/Core
	/Models
	/Views
/config
/database
/public
	/assets
	index.php
/img
```

## Requisitos

- PHP 8.0 ou superior
- MySQL ou MariaDB
- Extensão PDO habilitada
- Apache com `mod_rewrite` ou configuração equivalente

## Instalação local

1. Copie o projeto para `htdocs` no XAMPP ou para a pasta de sites do Laragon.
2. Importe o arquivo `database/schema.sql` no MySQL.
3. Configure as credenciais do banco por variáveis de ambiente ou no provedor de hospedagem:

```env
DB_DRIVER=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lanchonete_juvenil
DB_USERNAME=root
DB_PASSWORD=
DB_CHARSET=utf8mb4
```

4. Aponte o document root do servidor para a pasta `public/`.
5. Acesse `http://localhost` no navegador.

## Hospedagem compartilhada

1. Envie todos os arquivos para a hospedagem.
2. Configure o domínio para apontar para a pasta `public/`.
3. Se a hospedagem não permitir document root em `public/`, adapte o `.htaccess` e a configuração do servidor para manter `public/index.php` como front controller.
4. Crie o banco de dados e importe `database/schema.sql`.
5. Configure as credenciais do banco no painel da hospedagem.

## Acesso administrativo demo

- E-mail: `admin@juvenil.com`
- Senha: `Juvenil123!`

## Decisões técnicas

- MVC próprio, leve e fácil de hospedar em ambiente compartilhado.
- PDO com prepared statements para acesso ao banco.
- `password_hash()` e `password_verify()` para autenticação.
- Proteção CSRF nos formulários e endpoints de carrinho.
- CSS com variáveis baseadas na paleta da logo.
- Layout mobile-first com componentes visuais arredondados e marca forte.

## Próximos passos recomendados

1. Criar upload de imagens real para produtos.
2. Integrar notificações do pedido em tempo real.
3. Conectar pagamento Pix e leitura de QR Code.
4. Adicionar histórico do cliente e impressão de comanda.
# lanchonete-juvenil