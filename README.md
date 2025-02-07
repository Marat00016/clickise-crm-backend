## Установка и настройка

Чтобы развернуть проект, выполните следующие шаги:

### 1. Клонирование репозитория

```bash
git clone https://github.com/Marat00016/clickise-crm-backend.git
cd clickise-crm-backend
```

### 2. Необходимые пакеты

Перед установкой убедитесь, что у вас установлены следующие пакеты:

```bash
apt install make composer
```

### 3. Автоматическая настройка

Для автоматической установки зависимостей, настройки окружения и запуска приложения, выполните следующий скрипт:

```bash
make install
```
### 4. Запуск приложения вручную

Если вы предпочитаете выполнить шаги вручную, выполните следующие команды:

```bash
composer install --dev
cp .env.example .env
./vendor/bin/sail up
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
./vendor/bin/sail artisan jwt:secret
```
