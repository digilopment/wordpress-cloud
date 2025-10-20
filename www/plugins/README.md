wp-content/plugins/markiza-ai-headlines/
│
├── markiza-ai-headlines.php        // hlavný bootstrap súbor
├── src/
│   ├── Plugin.php
│   ├── Admin/
│   │   ├── AdminUI.php
│   │   ├── ACFIntegration.php
│   ├── Api/
│   │   ├── OpenAIClient.php
│   │   ├── Routes.php
│   ├── Cli/
│   │   └── GenerateTitlesCommand.php
│   ├── Storage/
│   │   └── TitlesRepository.php
│   └── Utils/
│       └── PromptBuilder.php
│
├── assets/
│   └── js/admin.js
│
└── README.md
