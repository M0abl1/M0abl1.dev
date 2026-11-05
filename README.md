# M0abl1.dev

Portfólio pessoal estático de Moab Lima Silva, otimizado para performance, acessibilidade e publicação no Firebase Hosting.

## Requisitos

- Node.js 20.19 ou superior
- Conta e projeto no Firebase

## Desenvolvimento

```powershell
npm install
npm run dev
```

## Build de produção

```powershell
npm run build
npm run preview
```

O conteúdo gerado fica em `dist/`. O Firebase Hosting publica somente essa pasta.

## Configurar e publicar no Firebase

```powershell
npx firebase-tools login
npx firebase-tools use --add
npm run deploy
```

O comando `use --add` cria o `.firebaserc` local com o projeto escolhido. Para CI/CD, configure o project ID no ambiente de publicação em vez de salvar credenciais no repositório.

## Arquitetura

- Vite para build e desenvolvimento
- HTML semântico, CSS e JavaScript sem framework em runtime
- Tema claro/escuro persistente
- Metadados SEO e Open Graph
- Cabeçalhos de segurança e cache no Firebase Hosting
- Sem dependências externas no navegador
