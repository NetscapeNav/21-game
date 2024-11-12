<!DOCTYPE html>
<html lang="ru">
<head>
    <link href="Acrom/stylesheet.css" rel="stylesheet" type="text/css" />
    <meta charset="UTF-8">
    <title>Игра в 21 очко</title>
<style>
    /* Основные стили страницы */
    * {
        font-family: 'Acrom', Arial, sans-serif;
    }
    html {
        height: 100%;
        cursor: url('cursor-win.png'), auto;
    }
    body {
        background-color: #2E7D32; /* Темно-зеленый фон, напоминающий карточный стол */
        color: #fff;
        text-align: center;
        padding: 20px;
    }
    #game-container {
        max-width: 900px;
        margin: 0 auto;
        background-color: #388E3C; /* Немного светлее зеленый фон для контейнера */
        padding: 20px;
        border-radius: 10px;
    }
    .hand {
        margin: 20px 0;
    }
    .cards {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }
    .card {
        background-color: #fff; /* Белый фон карт */
        color: #000;
        border-radius: 5px;
        padding: 10px;
        margin: 5px;
        width: 60px;
        height: 90px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
        opacity: 0;
        transform: translateY(-20px);
        animation: deal 0.5s forwards;
    }
    .modal {
        display: none; /* Скрыто по умолчанию */
        position: fixed; /* Остаётся на месте */
        z-index: 1; /* Поверх всего */
        left: 0;
        top: 0;
        width: 100%; /* Полная ширина */
        height: 100%; /* Полная высота */
        overflow: auto; /* Включить прокрутку, если нужно */
        background-color: rgba(0,0,0,0.5); /* Черный с прозрачностью */
    }
    .modal-content {
        background-color: #388E3C;
        margin: 15% auto; /* 15% сверху и центрирование */
        padding: 20px;
        border: 1px solid #888;
        width: 300px; /* Ширина модального окна */
        border-radius: 10px;
    }
    #winner-content {
        display: none;
    }
    @keyframes deal {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    #waiting-page {
        display: none; /* Скрыто по умолчанию */
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #2E7D32;
        color: #fff;
    }
    /* Стили кнопок управления */
    #controls button, .bet-button, .level-button, #view-leaderboard {
        padding: 10px 20px;
        margin: 10px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: #66BB6A; /* Зеленый цвет кнопок */
        color: #000;
        transition: background-color 0.3s;
    }
    /* Эффект наведения для кнопок */
    #controls button:hover, .bet-button:hover, .level-button:hover, #view-leaderboard:hover {
        background-color: #81C784;
    }
    button {
        font-weight: bold;
    }
    #message {
        font-size: 24px;
        margin-top: 20px;
        min-height: 30px; /* Чтобы сохранить место для текста */
        color: #ffeb3b; /* Желтый цвет текста для выделения */
    }
    /* Стили для отображения фишек */
    #chips {
        display: flex;
        justify-content: space-around;
        margin-bottom: 20px;
    }
    .chip-count {
        font-size: 18px;
    }
    #bet-buttons, #level-section {
        margin: 20px 0;
    }
    .hidden {
        display: none; /* Класс для скрытия элементов */
    }
    .card img {
        width: 100%;
        height: 100%;
        border-radius: 5px;
    }

    /* Дополнительные стили */

    /* Стили для полей ввода имени и произвольной ставки */
    #player-name, #custom-bet, #confirm {
        padding: 10px;
        margin: 10px 0;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        box-sizing: border-box;
    }

    /* Стили для кнопок сохранения и закрытия в модальном окне */
    #submit-name, #close-leaderboard {
        padding: 10px 20px;
        margin: 10px 5px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        background-color: #66BB6A; /* Зеленый цвет кнопок */
        color: #000;
        transition: background-color 0.3s;
    }

    #submit-name:hover, #closeLeaderboardButton:hover {
        background-color: #81C784; /* Светлее при наведении */
    }

    /* Стили для таймера */
    #timer {
        font-size: 20px;
        font-weight: bold;
        margin-top: 10px;
    }
    
    #facts {
        font-size: 20px;
        margin-top: 10px;
        width: 50%;
    }

    /* Стили для списка топ-10 игроков в лидерборде */
    #leaderboard-message ol {
        list-style-position: inside;
        padding-left: 0;
        text-align: left;
    }

    #leaderboard-message li {
        margin: 5px 0;
        font-size: 16px;
    }

    /* Стили для заголовков */
    #header {
        font-size: 36px;
        margin-bottom: 20px;
    }

    #level-section h2, #bet-section h2 {
        font-size: 24px;
        margin-bottom: 15px;
    }

    .hand h2 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    /* Дополнительные стили для страницы ожидания */
    #waiting-page h2 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    #waiting-page p {
        font-size: 18px;
        margin: 5px 0;
    }
    
    #post {
        position: absolute; 
        bottom: 0px;
        right: 0px;
    }
    
    #description {
        position: absolute; 
        bottom: 10px;
        left: 0px;
    }
    
    #post a {
        color: white;
    }
    
</style>

</head>
<body>
    <div id="waiting-page">
        <h2>Вы проиграли 3 раза.</h2>
        <p>Пожалуйста, подождите 3 минуты перед следующей игрой.</p>
        <p id="timer">Время осталось: 03:00</p>
        <p id="facts"></p>
    </div>
    <div id="game-container">
        <h1 id="header">Игра в 21</h1>
        <!-- Раздел отображения фишек игрока и дилера -->
        <h3 id="h-diff" style="display: none;">Уровень сложности: <span id="difficulty"></span></h3>
        <div id="chips">
            <div class="chip-count">Ваши фишки: <span id="player-chips">100</span></div>
            <div class="chip-count" id="bank-div" style="display:none;">Банк: <span id="bank-chips">0</span></div>
            <div class="chip-count">Фишки дилера: <span id="dealer-chips">100</span></div>
        </div>
        <!-- Раздел выбора уровня сложности -->
        <div id="level-section">
            <h2>Выберите уровень сложности:</h2>
            <div id="level-buttons">
                <button class="level-button" data-level="1" id="easy">Легкий</button>
                <button class="level-button" data-level="2" id="normal">Средний</button>
                <button class="level-button" data-level="3" id="hard">Сложный</button>
                <button class="level-button" data-level="4" id="infinite">Рейтинговый</button>
                <button class="level-button" data-level="5" id="hundred-and-one">Игра в 101</button><br/>
                <button id="view-leaderboard">Просмотреть топ-10</button>
            </div>
        </div>
        <!-- Раздел ставок -->
        <div id="bet-section" class="hidden">
            <h2>Сделайте ставку:</h2>
            <div id="bet-buttons">
                <!-- Кнопки для выбора суммы ставки -->
                <button class="bet-button" data-bet="10">10</button>
                <button class="bet-button" data-bet="20">20</button>
                <button class="bet-button" data-bet="50">50</button>
                <button class="bet-button" data-bet="100">100</button>
                <input type="number" id="custom-bet" placeholder="Произвольная ставка" min="1" />
                <button id="confirm">Играть</button>
            </div>
        </div>
        <!-- Раздел с картами игрока -->
        <div class="hand hidden" id="player-section">
            <h2>Ваши карты (<span id="player-score">0</span> <span id="player-points">очков</span>)</h2>
            <div class="cards" id="player-cards">
                <!-- Здесь будут отображаться карты игрока -->
            </div>
        </div>
        <!-- Раздел с картами дилера -->
        <div class="hand hidden" id="dealer-section">
            <h2>Карты дилера (<span id="dealer-score">0</span> <span id="dealer-points">очков</span>)</h2>
            <div class="cards" id="dealer-cards">
                <!-- Здесь будут отображаться карты дилера -->
            </div>
        </div>
        <!-- Контролы игры: взять карту, остановиться, начать заново -->
        <div id="controls" class="hidden">
            <button id="hit-button">Взять карту</button>
            <button id="stand-button">Пас</button>
            <button id="cheat-button" style="display: none;">Ввести чит-код</button>
            <button id="restart-button" style="display: none;">Начать заново</button>
            <button id="leaderboard-button" style="display: none;">Записать результат в рейтинг</button>
            <button id="menu-button" style="display: none;">В меню</button>
        </div>
        <!-- Раздел для сообщений о результате -->
        <div id="message"></div>
    </div>
    
    <!-- Модальное окно для ввода имени в лидерборд -->
    <div id="leaderboard-modal" class="modal">
        <div class="modal-content">
            <div id="winner-content">
                <h3>Поздравляем! Вы вошли в топ-10.</h3>
                <input type="text" id="player-name" placeholder="Ваше имя">
                <button id="submit-name">Сохранить</button>
            </div>
            <button id="close-leaderboard">Закрыть</button>
            <p id="leaderboard-message" style="color: #ffeb3b; margin-top:10px;"></p>
        </div>
    </div>

    <p id="description">Уточнение относительно правил</p>
    <p id="post"><em><b>Made at <a href="/index.php">SEP Technologies</a></b></em>, 2024</p>
    <script>
        // Определение мастей и значений карт
        const suits = ['♠', '♥', '♦', '♣'];
        const values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        const facts = ['Азартные игры вызывают выброс дофамина, похожий на воздействие наркотиков и алкоголя, что ускоряет привыкание и способствует зависимости.', 'Люди с игровой зависимостью чаще прибегают к азартным играм, чтобы справиться с депрессией, тревогой или стрессом.', 'Ежегодно в мире с лудоманией сталкивается 350 млн человек (данные ВОЗ). Рост числа лудоманов за 10 лет – 500%.', 'Лудомания часто начинается с малых ставок, которые со временем увеличиваются. Желание вернуть проигранные деньги может привести к огромным долгам.', 'Игровая зависимость бывает трудно распознать, так как люди скрывают её от семьи и друзей, что приводит к изоляции и усугубляет проблему.', 'Онлайн-казино используют генераторы случайных чисел (ГСЧ), которые обеспечивают честность игры, но многие казино также используют алгоритмы, увеличивающие шансы проигрыша при долгой игре.', 'В пандемию COVID-19 количество пользователей онлайн-казино заметно выросло. Многие искали азартных развлечений и отвлечения от рутины и тревожных мыслей.', 'Азартные игры породили как крупнейшие выигрыши, так и крупнейшие личные финансовые потери в истории. Некоторые игроки за одну ночь выигрывали миллионы, а некоторые — проигрывали всё состояние.', 'Хотя существует много стратегий и \"систем\", которые якобы увеличивают шансы на победу, реальность такова, что ни одна система не способна преодолеть математику, заложенную в азартные игры: казино всегда остаётся в выигрыше.', 'Доказано, что у людей с игровой зависимостью повышается риск депрессии, тревожности и даже суицидальных мыслей.', 'Около 30–40% людей с игровой зависимостью играют, чтобы снять стресс, а не из-за жажды выигрыша', 'В среднем онлайн-казино могут генерировать около $14,9 миллиона валового дохода в год, что составляет примерно $1,24 миллиона в месяц.', 'В 2007 году американский бизнесмен Теренс Ватанабе проиграл около $127 миллионов в казино Лас-Вегаса, что стало одним из крупнейших личных проигрышей в истории', 'Хотя существуют различные "системы", такие как "Система Мартингейла", исследования показывают, что только 5% игроков могут выйти в ноль или выиграть в долгосрочной перспективе. Остальные неизменно теряют деньги'];

        // Инициализация переменных игры
        let deck = []; // Колода карт
        let playerHand = []; // Рука игрока
        let dealerHand = []; // Рука дилера
        let gameOver = false; // Флаг окончания игры
        let currentBet = 0; // Текущая ставка
        let currentLevel = 1; // Текущий уровень сложности (1 - легкий, 2 - средний, 3 - сложный)
        let maxLevel = 1;
        let countBankrupts = 0;

        // Фишки игроков
        let playerChips = 100; // Фишки игрока
        let dealerChips = 100; // Фишки дилера
        
        let restrictionActive = false;
        let restrictionEndTime = null;
        
        let oneHundredAndOne = 0;
        let infiniteMode = 0;

        // Получение элементов DOM для взаимодействия с ними
        const headerGame = document.getElementById('header');
        const playerCardsDiv = document.getElementById('player-cards');
        const dealerCardsDiv = document.getElementById('dealer-cards');
        const playerScoreSpan = document.getElementById('player-score');
        const dealerScoreSpan = document.getElementById('dealer-score');
        const playerPointsSpan = document.getElementById('player-points');
        const dealerPointsSpan = document.getElementById('dealer-points');
        const messageDiv = document.getElementById('message');
        const hitButton = document.getElementById('hit-button');
        const standButton = document.getElementById('stand-button');
        const cheatButton = document.getElementById('cheat-button');
        const leaderboardButton = document.getElementById('leaderboard-button');
        const restartButton = document.getElementById('restart-button');
        const menuButton = document.getElementById('menu-button');
        const betButtons = document.querySelectorAll('.bet-button');
        const playerChipsSpan = document.getElementById('player-chips');
        const dealerChipsSpan = document.getElementById('dealer-chips');
        const bankChipsSpan = document.getElementById('bank-chips');
        const bankDiv = document.getElementById('bank-div');
        const viewLeaderboardButton = document.getElementById('view-leaderboard');
        const winnerContent = document.getElementById('winner-content');
        const customBetInput = document.getElementById('custom-bet');
        const confirmButton = document.getElementById('confirm');
        const betSection = document.getElementById('bet-section');
        const difficultyLevel = document.getElementById('difficulty');
        const difficultyHeader = document.getElementById('h-diff');
        const playerSection = document.getElementById('player-section');
        const dealerSection = document.getElementById('dealer-section');
        const controlsDiv = document.getElementById('controls');
        const levelButtons = document.querySelectorAll('.level-button');
        const levelSection = document.getElementById('level-section');
        const waitingPage = document.getElementById('waiting-page');
        const timerDisplay = document.getElementById('timer');
        const factsDisplay = document.getElementById('facts');
        const rules = document.getElementById('description');
        
        // Leaderboard Modal элементы
        const leaderboardModal = document.getElementById('leaderboard-modal');
        const submitNameButton = document.getElementById('submit-name');
        const closeLeaderboardButton = document.getElementById('close-leaderboard');
        const playerNameInput = document.getElementById('player-name');
        const leaderboardMessage = document.getElementById('leaderboard-message');
        
        console.log(maxLevel);
        /**
         * Функция для корректного склонения слова "очков" в зависимости от числа
         * @param {number} number - Число очков
         * @returns {string} - Правильная форма слова "очков"
         */
        function getPointsWord(number) {
            number = Math.abs(number); // Убираем знак числа
            const lastDigit = number % 10; // Последняя цифра
            const lastTwoDigits = number % 100; // Последние две цифры
            if (lastDigit === 1 && lastTwoDigits !== 11) {
                return 'очко';
            }
            if ([2, 3, 4].includes(lastDigit) && ![12, 13, 14].includes(lastTwoDigits)) {
                return 'очка';
            }
            return 'очков';
        }

        /**
         * Функция для создания новой колоды карт
         */
        function createDeck() {
            deck = []; // Очистка текущей колоды
            for (let suit of suits) { // Проход по каждой масти
                for (let value of values) { // Проход по каждому значению карты
                    deck.push({suit, value}); // Добавление карты в колоду
                }
            }
        }

        /**
         * Функция для перемешивания колоды карт методом Фишера-Йетса
         */
        function shuffleDeck() {
            for (let i = deck.length - 1; i > 0; i--) { // Начинаем с конца колоды
                const j = Math.floor(Math.random() * (i + 1)); // Выбираем случайный индекс
                [deck[i], deck[j]] = [deck[j], deck[i]]; // Меняем местами текущую карту с выбранной
            }
        }

        /**
         * Функция для начала новой игры после размещения ставки
         */
        function startGame() {
            createDeck(); // Создание новой колоды
            shuffleDeck(); // Перемешивание колоды
            playerHand = [drawCard(), drawCard()]; // Раздача двух карт игроку
            dealerHand = [drawCard(), drawCard()]; // Раздача двух карт дилеру
            gameOver = false; // Сбрасываем флаг окончания игры
            messageDiv.textContent = ''; // Очищаем сообщения
            betSection.classList.add('hidden'); // Скрываем раздел ставок
            bankDiv.style.display = "inline-block";
            playerSection.classList.remove('hidden'); // Отображаем раздел с картами игрока
            dealerSection.classList.remove('hidden'); // Отображаем раздел с картами дилера
            controlsDiv.classList.remove('hidden'); // Отображаем контролеры игры
            if (currentLevel == 4) {
                leaderboardButton.style.display = "inline-block";
            } else {
                leaderboardButton.style.display = "none";
            }
            updateDisplay(); // Обновляем отображение карт и фишек
            //checkForBlackjack(); // Проверяем наличие 21 очка
        }

        /**
         * Функция для взятия карты из колоды
         * @returns {object} - Объект карты
         */
        function drawCard() {
            /*if (deck.length === 0) { // Если колода пуста !!!!!! НУЖНО ПЕРЕПИСАТЬ
                createDeck(); // Создаём новую колоду
                shuffleDeck(); // Перемешиваем её
            }*/
            return deck.pop(); // Возвращаем последнюю карту из колоды
        }

        /**
         * Функция для расчета очков руки
         * @param {Array} hand - Массив карт
         * @returns {number} - Сумма очков
         */
        function calculateScore(hand) {
            let score = 0; // Изначально 0 очков
            let aces = 0; // Количество тузов
            for (let card of hand) { // Проходим по каждой карте в руке
                if (['J', 'Q', 'K'].includes(card.value)) { // Валеты, дамы и короли дают 10 очков
                    score += 10;
                } else if (card.value === 'A') { // Туз
                    aces += 1;
                    score += 11; // Изначально считаем туз за 11
                } else { // Остальные карты дают соответствующее число очков
                    score += parseInt(card.value);
                }
            }
            // Если сумма очков больше 21 и есть туз, преобразуем туз из 11 в 1
            while (score > 21 && aces > 0) {
                score -= 10;
                aces -= 1;
            }
            return score; // Возвращаем итоговую сумму очков
        }

        /**
         * Функция для получения начальной буквы масти для URL изображений
         * @param {string} suit - Масть карты
         * @returns {string} - Начальная буква масти
         */
        function getSuitInitial(suit) {
            switch(suit) {
                case '♠': return 'S';
                case '♥': return 'H';
                case '♦': return 'D';
                case '♣': return 'C';
                default: return '';
            }
        }
        
        /**
         * Функция для обновления отображения карт и фишек
         */
        function updateDisplay() {
            // Очищаем текущие карты на экране
            playerCardsDiv.innerHTML = '';
            dealerCardsDiv.innerHTML = '';

            // Отображаем карты игрока
            for (let card of playerHand) {
                const cardDiv = document.createElement('div');
                cardDiv.classList.add('card');
                let cardCode = card.value;
                if (card.value === '10') {
                    cardCode = '0'; // Заменяем '10' на '0' для URL
                }
                cardDiv.innerHTML = `<img src="cards/${cardCode}${getSuitInitial(card.suit)}.png" alt="${card.value}${card.suit}">`;
                //cardDiv.textContent = `${card.value}${card.suit}`; // Формат: значение + масть
                playerCardsDiv.appendChild(cardDiv);
            }
            const playerScore = calculateScore(playerHand); // Расчитываем очки игрока
            playerScoreSpan.textContent = playerScore; // Отображаем очки
            playerPointsSpan.textContent = getPointsWord(playerScore); // Отображаем правильную форму слова "очков"

            // Отображаем карты дилера
            for (let i = 0; i < dealerHand.length; i++) {
                const cardDiv = document.createElement('div');
                cardDiv.classList.add('card');
                if (i === 0 && !gameOver) {
                    cardDiv.innerHTML = `<img src="cards/back.png" alt="Закрытая карта">`; // Закрытая карта дилера
                } else {
                    let cardCode = dealerHand[i].value;
                    if (dealerHand[i].value === '10') {
                        cardCode = '0'; // Заменяем '10' на '0' для URL
                    }
                    cardDiv.innerHTML = `<img src="cards/${cardCode}${getSuitInitial(dealerHand[i].suit)}.png" alt="${dealerHand[i].value.value}${dealerHand[i].suit}">`;
                }
                /*if (i === 0 && !gameOver) {
                    cardDiv.textContent = '🂠'; // Закрытая карта дилера
                } else {
                    cardDiv.textContent = `${dealerHand[i].value}${dealerHand[i].suit}`;
                }*/
                dealerCardsDiv.appendChild(cardDiv);
            }
            // Если игра не окончена, показываем только одну открытую карту дилера
            const dealerScore = gameOver ? calculateScore(dealerHand) : calculateScore([dealerHand[1]]);
            dealerScoreSpan.textContent = dealerScore;
            dealerPointsSpan.textContent = getPointsWord(dealerScore);

            // Обновляем отображение фишек
            playerChipsSpan.textContent = playerChips;
            dealerChipsSpan.textContent = dealerChips;

            // Сохраняем состояние игры в куки
            saveGameState();
        }

        /**
         * Функция для проверки наличия 21 очка у игрока или дилера
         */
        function checkForBlackjack() {
            const playerScore = calculateScore(playerHand);
            const dealerScore = calculateScore(dealerHand);
            if (playerScore === 21 || dealerScore === 21) {
                //endGame(); // Если кто-то имеет 21, завершаем игру
            }
        }

        /**
         * Обработчик события для кнопки "Взять карту"
         */
        hitButton.addEventListener('click', () => {
            if (!gameOver) { // Если игра не окончена
                playerHand.push(drawCard()); // Добавляем карту игроку
                updateDisplay(); // Обновляем отображение
                const playerScore = calculateScore(playerHand);
                if ((playerScore > 21 && oneHundredAndOne == 0) || (playerScore > 101 && oneHundredAndOne == 1)) { // Если перебор
                    endGame(); // Завершаем игру
                } else if (playerScore === 101 && oneHundredAndOne == 1) { // Если 101
                    // Автоматически завершаем ход дилера
                    standButton.click();
                }
            }
        });
        
        viewLeaderboardButton.addEventListener('click', () => {
            leaderboardModal.style.display = "block";
        });
        
        rules.addEventListener('click', () => {
            alert("Сначала вы играете на лёгком уровне. После того как у дилера кончаются фишки, вам открывается новый уровень.");
            alert("Рейтинговый уровень и игра в 101 открываются сразу после победы на сложном уровне.");
            alert("Игра в 101 отличается от игры в 21 только тем, что для победы нужно приблизиться не к 21, а к 101.");
            alert("Чтобы попасть в топ-10, нужно попасть на рейтинговый уровень и получить как можно больше фишек.");
            alert("Чтобы вернуться в меню выбора уровней — обновите страницу.");
            alert("Король, дама, валет — 10 очков. Туз — 1 или 11 очков, в зависимости от выгоды.");
            alert("Если у вас закончатся фишки, вам будет выдано 100 фишек автоматически, однако увеличится счётчик банкроств. Если счётчик станет равным 3, то на вас будет наложено 3-минутное ограничение");
            alert("В случае ошибок или других пакостей, которые мы не нашли, пишите на почту mail@sepcode.ru или тем, откуда вы узнали про эту игру/сайт.");
        });

        /**
         * Обработчик события для кнопки "Стоп"
         */
        standButton.addEventListener('click', () => {
            if (!gameOver) { // Если игра не окончена
                gameOver = true; // Устанавливаем флаг окончания игры
                updateDisplay(); // Обновляем отображение (открываем карты дилера)
                dealerTurn(); // Ход дилера
                updateDisplay(); // Обновляем отображение после хода дилера
                endGame(); // Завершаем игру
            }
        });
        
        leaderboardButton.addEventListener('click', () => {
            displayLeaderboard();
            leaderboardModal.style.display = "block";
            winnerContent.style.display = "block";
        });
        
        closeLeaderboardButton.addEventListener('click', () => {
            leaderboardModal.style.display = "none";
            winnerContent.style.display = "none";
        });
        
        submitNameButton.addEventListener('click', () => {
            const playerName = playerNameInput.value.trim();
            if (playerName === '') {
                leaderboardMessage.textContent = 'Пожалуйста, введите ваше имя.';
                return;
            }
            addToLeaderboard(playerName, playerChips);
            leaderboardModal.style.display = 'none';
            menuButton.style.display = 'none'; // Скрываем кнопку "Начать заново"
            difficultyHeader.style.display = 'none';
            restartButton.style.display = 'none'; // Скрываем кнопку "Начать заново"
            hitButton.style.display = 'inline-block'; // Показываем кнопку "Взять карту"
            standButton.style.display = 'inline-block'; // Показываем кнопку "Стоп"
            playerSection.classList.add('hidden'); // Скрываем раздел с картами игрока
            dealerSection.classList.add('hidden'); // Скрываем раздел с картами дилера
            controlsDiv.classList.add('hidden'); // Скрываем контролы игры
            levelSection.classList.remove('hidden'); // Показываем раздел ставок
            messageDiv.textContent = '';
        });
        
        function showLeaderboard() {
            leaderboardModal.style.display = 'block';
            leaderboardMessage.textContent = '';
            playerNameInput.value = '';
        }
        
        /**
         * Функция для добавления результата в лидерборд через сервер
         * @param {string} playerName - Имя игрока
         * @param {number} chips - Количество фишек
         */
        function addToLeaderboard(playerName, chips) {
            fetch('leaderboard.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ name: playerName, chips: chips })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Ваш результат сохранен в топ-10.');
                    leaderboardModal.style.display = 'none';
                } else {
                    alert('Ошибка при сохранении результата: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Ошибка при отправке данных:', error);
                alert('Произошла ошибка при сохранении результата.');
            });
        }
        
        /**
         * Функция для получения и отображения текущего лидерборда
         */
        function displayLeaderboard() {
            fetch('leaderboard.php', {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const leaderboard = data.leaderboard;
                    let html = '<h3>Топ-10 игроков:</h3><ol>';
                    leaderboard.forEach(entry => {
                        html += `<li>${entry.name} - ${entry.chips} фишек</li>`;
                    });
                    html += '</ol>';
                    leaderboardMessage.innerHTML = html;
                } else {
                    leaderboardMessage.textContent = 'Не удалось загрузить топ.';
                }
            })
            .catch(error => {
                console.error('Ошибка при получении топа:', error);
                leaderboardMessage.textContent = 'Произошла ошибка при загрузке топа.';
            });
        }
        
        menuButton.addEventListener('click', () => {
            if (countBankrupts >= 3) {
                saveGameState();
                showWaitingPage();
                return;
            }
            menuButton.style.display = 'none'; // Скрываем кнопку "Начать заново"
            difficultyHeader.style.display = 'none';
            restartButton.style.display = 'none'; // Скрываем кнопку "Начать заново"
            hitButton.style.display = 'inline-block'; // Показываем кнопку "Взять карту"
            standButton.style.display = 'inline-block'; // Показываем кнопку "Стоп"
            playerSection.classList.add('hidden'); // Скрываем раздел с картами игрока
            dealerSection.classList.add('hidden'); // Скрываем раздел с картами дилера
            controlsDiv.classList.add('hidden'); // Скрываем контролы игры
            levelSection.classList.remove('hidden'); // Показываем раздел ставок
            messageDiv.textContent = '';
        });

        /**
         * Функция, отвечающая за ход дилера с учётом уровня сложности
         */
        function dealerTurn() {
            let dealerScore = calculateScore(dealerHand); // Расчитываем очки дилера
            while (true) { // Пока дилер должен брать карты
                if (currentLevel === 1) { // Легкий уровень
                    // Дилер всегда берет карту, если его счет меньше 16
                    if (dealerScore < 16) {
                        dealerHand.push(drawCard());
                        dealerScore = calculateScore(dealerHand); // Обновляем очки
                    } else {
                        break; // Иначе останавливаемся
                    }
                } else if (currentLevel === 2) { // Средний уровень
                    // Дилер берет карту до 18
                    if (dealerScore < 18) {
                        dealerHand.push(drawCard());
                        dealerScore = calculateScore(dealerHand);
                    } else {
                        break;
                    }
                } else if (currentLevel === 3) { // Сложный уровень
                    // Дилер использует более сложную стратегию
                    // Например, берет карту, если его счет меньше счета игрока и меньше 21
                    const playerScore = calculateScore(playerHand);
                    if (dealerScore < playerScore && dealerScore < 21) {
                        dealerHand.push(drawCard());
                        dealerScore = calculateScore(dealerHand);
                    } else if (dealerScore < 17) {
                        dealerHand.push(drawCard());
                        dealerScore = calculateScore(dealerHand);
                    } else {
                        break;
                    }
                } else if (currentLevel === 4) { // Бесконечная
                    // Дилер использует более сложную стратегию
                    // Например, берет карту, если его счет меньше счета игрока и меньше 21
                    const playerScore = calculateScore(playerHand);
                    if (dealerScore < playerScore && dealerScore < 21) {
                        dealerHand.push(drawCard());
                        dealerScore = calculateScore(dealerHand);
                    } else if (dealerScore < 17) {
                        dealerHand.push(drawCard());
                        dealerScore = calculateScore(dealerHand);
                    } else {
                        break;
                    }
                } else if (currentLevel === 5) { // Игра в 101
                    // Дилер использует более сложную стратегию
                    // Например, берет карту, если его счет меньше счета игрока и меньше 101
                    const playerScore = calculateScore(playerHand);
                    if (dealerScore < playerScore && dealerScore < 101) {
                        dealerHand.push(drawCard());
                        dealerScore = calculateScore(dealerHand);
                    } else if (dealerScore < 97) {
                        dealerHand.push(drawCard());
                        dealerScore = calculateScore(dealerHand);
                    } else {
                        break;
                    }
                }
            }
        }

        /**
         * Функция для завершения игры и определения результата
         */
        function endGame() {
            gameOver = true; // Устанавливаем флаг окончания игры
            hitButton.style.display = 'none'; // Скрываем кнопку "Взять карту"
            standButton.style.display = 'none'; // Скрываем кнопку "Стоп"
            cheatButton.style.display = 'none'; // Скрываем кнопку "Чит-код"
            restartButton.style.display = 'inline-block'; // Показываем кнопку "Начать заново"

            const playerScore = calculateScore(playerHand); // Очки игрока
            const dealerScore = calculateScore(dealerHand); // Очки дилера

            // Обновляем отображение очков после завершения игры
            playerScoreSpan.textContent = playerScore;
            playerPointsSpan.textContent = getPointsWord(playerScore);
            
            if ((playerScore > 21 && oneHundredAndOne == 0) || (playerScore > 101 && oneHundredAndOne == 1)) { 
                ;
            } else {
                dealerScoreSpan.textContent = dealerScore;
                dealerPointsSpan.textContent = getPointsWord(dealerScore);
            }

            // Определение результата игры и обновление фишек
            if ((playerScore > 21 && oneHundredAndOne == 0) || (playerScore > 101 && oneHundredAndOne == 1)) { // Игрок перебрал
                messageDiv.textContent = 'Вы проиграли! Перебор.';
                dealerChips += currentBet; // Дилер получает ставку
            } else if ((dealerScore > 21 && oneHundredAndOne == 0) || (dealerScore > 101 && oneHundredAndOne == 1)) { // Дилер перебрал
                messageDiv.textContent = 'Вы выиграли! Дилер перебрал.';
                playerChips += currentBet; // Игрок получает ставку
            } else if (playerScore === dealerScore) { // Ничья
                messageDiv.textContent = 'Ничья!';
                playerChips += currentBet/2;
                dealerChips += currentBet/2;
                // Ставка возвращается игроку (ничья)
            } else if (playerScore === 21 && playerHand.length === 2 && oneHundredAndOne == 0) { // Игрок получил 21 очко
                messageDiv.textContent = 'У вас 21 очко! Вы выиграли!';
                playerChips += currentBet; // Обычно 21 очко выплачивается 3:2
            } else if (dealerScore === 21 && dealerHand.length === 2 && oneHundredAndOne == 0) { // Дилер получил 21 очко
                messageDiv.textContent = 'Дилер получил 21 очко! Вы проиграли.';
                dealerChips += currentBet; // Дилер получает ставку
            } else if (playerScore > dealerScore) { // Игрок выигрывает
                messageDiv.textContent = 'Вы выиграли!';
                playerChips += currentBet; // Игрок получает ставку
            } else { // Дилер выигрывает
                messageDiv.textContent = 'Дилер выиграл!';
                dealerChips += currentBet; // Дилер получает ставку
            }

            // Проверка, есть ли у игроков фишки для продолжения игры
            if (playerChips <= 0) { // У игрока закончились фишки
                messageDiv.textContent += ' Вы потеряли все фишки. Игра окончена.';
                disableAllButtonsLose(); // Отключаем все кнопки ставок и управления
            } else if (dealerChips <= 0) { // У дилера закончились фишки
                messageDiv.textContent += ' Дилер потерял все фишки. Вы выиграли игру!';
                disableAllButtonsWin(); // Отключаем все кнопки ставок и управления
            }
            
            playerChipsSpan.textContent = playerChips; // Обновляем отображение фишек игрока
            dealerChipsSpan.textContent = dealerChips; // Обновляем отображение фишек дилера
            bankChipsSpan.textContent = 0;
            bankDiv.style.display = "none";
            
            currentBet = 0;

            // Сохраняем состояние игры в куки после завершения раунда
            saveGameState();
        }

        /**
         * Функция для отключения всех кнопок ставок и управления игрой
         */
        function disableAllButtonsLose() {
            countBankrupts++;
            restartButton.style.display = 'none';
            menuButton.style.display = 'inline-block';
            playerChips += 100;
            dealerChips = 100;
            playerChipsSpan.textContent = playerChips;
        }
        
        function disableAllButtonsWin() {
            if (currentLevel == maxLevel) {
                maxLevel++;
            }
            restartButton.style.display = 'none';
            menuButton.style.display = 'inline-block';
        }

        /**
         * Обработчик события для кнопки "Начать заново"
         */
        restartButton.addEventListener('click', () => {
            // Обновляем отображение фишек
            playerChipsSpan.textContent = playerChips;
            dealerChipsSpan.textContent = dealerChips;
            bankChipsSpan.textContent = 0;

            // Сбрасываем интерфейс для начала нового раунда
            restartButton.style.display = 'none'; // Скрываем кнопку "Начать заново"
            hitButton.style.display = 'inline-block'; // Показываем кнопку "Взять карту"
            standButton.style.display = 'inline-block'; // Показываем кнопку "Стоп"
            hitButton.disabled = false; // Включаем кнопку "Взять карту"
            standButton.disabled = false; // Включаем кнопку "Стоп"
            hitButton.style.backgroundColor = '#66BB6A'; // Возвращаем исходный цвет
            standButton.style.backgroundColor = '#66BB6A'; // Возвращаем исходный цвет
            betButtons.forEach(button => {
                button.disabled = false; // Включаем все кнопки ставок
                button.style.backgroundColor = '#66BB6A'; // Возвращаем исходный цвет
                button.style.cursor = 'pointer'; // Возвращаем курсор
            });
            messageDiv.textContent = ''; // Очищаем сообщения
            customBetInput.value = '';
            playerHand = []; // Очищаем руку игрока
            dealerHand = []; // Очищаем руку дилера
            playerSection.classList.add('hidden'); // Скрываем раздел с картами игрока
            dealerSection.classList.add('hidden'); // Скрываем раздел с картами дилера
            controlsDiv.classList.add('hidden'); // Скрываем контролы игры
            betSection.classList.remove('hidden'); // Показываем раздел ставок
        });

        /**
         * Обработчик событий для кнопок ставок
         */
        betButtons.forEach(button => {
            button.addEventListener('click', () => {
                const bet = parseInt(button.getAttribute('data-bet')); // Получаем сумму ставки из атрибута data-bet
                if (bet > playerChips) { // Проверяем, достаточно ли фишек у игрока
                    alert('У вас недостаточно фишек для такой ставки!');
                    return; // Прерываем выполнение, если фишек недостаточно
                }
                // Дилер делает ставку той же суммы
                if (dealerChips < bet) { // Если у дилера недостаточно фишек
                    alert('У дилера недостаточно фишек для ставки. Ставка снижена до оставшихся фишек.');
                    currentBet = dealerChips; // Устанавливаем ставку равной оставшимся фишкам дилера
                    playerChips -= dealerChips; // Вычитаем ставку из фишек игрока
                } else {
                    currentBet = bet; // Устанавливаем текущую ставку
                    playerChips -= bet; // Вычитаем ставку из фишек игрока
                }
                playerChipsSpan.textContent = playerChips; // Обновляем отображение фишек игрока
                dealerChips -= currentBet; // Вычитаем ставку из фишек дилера
                dealerChipsSpan.textContent = dealerChips; // Обновляем отображение фишек дилера
                currentBet *= 2;
                
                bankChipsSpan.textContent = currentBet;
                // Сохраняем обновлённые фишки в куки перед началом игры
                saveGameState();
                startGame(); // Начинаем игру
            });
        });
        
        confirmButton.addEventListener('click', () => {
            const bet = parseInt(customBetInput.value);
            if (isNaN(bet) || bet < 1) {
                alert('Пожалуйста, введите корректную сумму ставки (не менее 1 фишки).');
                return;
            }
            if (bet > playerChips) {
                alert('У вас недостаточно фишек для такой ставки!');
                return;
            }
            
            if (dealerChips < bet) { // Если у дилера недостаточно фишек
                alert('У дилера недостаточно фишек для ставки. Ставка снижена до оставшихся фишек.');
                currentBet = dealerChips; // Устанавливаем ставку равной оставшимся фишкам дилера
                playerChips -= dealerChips; // Вычитаем ставку из фишек игрока
            } else {
                currentBet = bet; // Устанавливаем текущую ставку
                playerChips -= bet; // Вычитаем ставку из фишек игрока
            }
            playerChipsSpan.textContent = playerChips; // Обновляем отображение фишек игрока
            dealerChips -= currentBet; // Вычитаем ставку из фишек дилера
            dealerChipsSpan.textContent = dealerChips; // Обновляем отображение фишек дилера
            currentBet *= 2;
                
            bankChipsSpan.textContent = currentBet;
            saveGameState();
            startGame();
        });

        /**
         * Обработчик событий для кнопок выбора уровня сложности
         */
        levelButtons.forEach(button => {
            button.addEventListener('click', () => {
                currentLevel = parseInt(button.getAttribute('data-level')); // Устанавливаем выбранный уровень сложности
                console.log(maxLevel, currentLevel);
                if (maxLevel >= currentLevel || maxLevel >= 4) {
                    levelSection.classList.add('hidden'); // Скрываем раздел выбора уровня
                    betSection.classList.remove('hidden'); // Показываем раздел ставок
                    difficultyHeader.style.display = "inline-block";
                    if (currentLevel == 1) {
                        headerGame.textContent = "Игра в 21";
                        difficultyLevel.innerHTML = "лёгкий уровень";
                        if (dealerChips < 100 || dealerChips == Infinity) {
                            dealerChips = 100;
                        }
                    } else if (currentLevel == 2) {
                        headerGame.textContent = "Игра в 21";
                        difficultyLevel.innerHTML = "средний уровень";
                        if (dealerChips < 150 || dealerChips == Infinity) {
                            dealerChips = 150;
                        }
                    } else if (currentLevel == 3) {
                        headerGame.textContent = "Игра в 21";
                        difficultyLevel.innerHTML = "сложный уровень";
                        if (dealerChips < 200 || dealerChips == Infinity) {
                            dealerChips = 200;
                        }
                    } else if (currentLevel == 4) {
                        headerGame.textContent = "Игра в 21";
                        difficultyLevel.innerHTML = "бесконечный режим";
                        dealerChips = Infinity;
                    } else if (currentLevel == 5) {
                        headerGame.textContent = "Игра в 101";
                        difficultyLevel.innerHTML = "игра в 101";
                        oneHundredAndOne = 1;
                        if (dealerChips < 100 || dealerChips == Infinity) {
                            dealerChips = 100;
                        }
                    }
                    dealerChipsSpan.textContent = dealerChips; 
                    // Сохраняем выбранный уровень в куки
                    saveGameState();
                } else {
                    alert("Этот уровень сложности ещё не доступен.");
                }
            });
        });

        /**
         * Функция для сохранения состояния игры в куки
         */
        function saveGameState() {
            // Создаем объект состояния игры
            const gameState = {
                playerChips: playerChips,
                dealerChips: dealerChips,
                currentLevel: currentLevel,
                maxLevel: maxLevel,
                currentBet: currentBet,
                countBankrupts: countBankrupts,
                restrictionActive: restrictionActive,
                restrictionEndTime: restrictionEndTime
            };
            // Преобразуем объект в строку JSON
            const gameStateStr = JSON.stringify(gameState);
            // Устанавливаем куки с именем 'gameState', значением gameStateStr и сроком действия 30 дней
            document.cookie = `gameState=${encodeURIComponent(gameStateStr)}; path=/; max-age=${30 * 24 * 60 * 60}`;
        }

        /**
         * Функция для загрузки состояния игры из куки
         */
        function loadGameState() {
            const cookies = document.cookie.split(';').map(cookie => cookie.trim()); // Разбиваем куки на отдельные элементы
            for (let cookie of cookies) { // Проходим по каждому элементу
                if (cookie.startsWith('gameState=')) { // Ищем куки с именем 'gameState'
                    const gameStateStr = decodeURIComponent(cookie.substring('gameState='.length)); // Получаем значение куки
                    try {
                        const gameState = JSON.parse(gameStateStr); // Парсим строку JSON в объект
                        playerChips = gameState.playerChips + (gameState.currentBet/2); // Восстанавливаем фишки игрока
                        dealerChips = gameState.dealerChips + (gameState.currentBet/2); // Восстанавливаем фишки дилера
                        currentLevel = gameState.currentLevel; // Восстанавливаем уровень сложности
                        maxLevel = gameState.maxLevel; // Восстанавливаем уровень сложности
                        currentBet = 0; // Восстанавливаем уровень сложности
                        countBankrupts = gameState.countBankrupts;
                        restrictionActive = gameState.restrictionActive;
                        restrictionEndTime = gameState.restrictionEndTime;
                        playerChipsSpan.textContent = playerChips; // Обновляем отображение фишек игрока
                        dealerChipsSpan.textContent = dealerChips; // Обновляем отображение фишек дилера
                        bankChipsSpan.textContent = 0;
                        return; // Завершаем функцию после загрузки состояния
                    } catch (e) {
                        console.error('Ошибка при парсинге состояния игры из куки:', e);
                        // Если произошла ошибка, не восстанавливаем состояние
                    }
                }
            }
            // Если куки не найдены или произошла ошибка, устанавливаем начальные значения
            playerChips = 100;
            dealerChips = 100;
            currentLevel = 1;
            maxLevel = 1;
            currentBet = 0;
            countBankrupts = 0;
            restrictionActive = false;
            restrictionEndTime = null;
        }

        /**
         * Функция для инициализации игры при загрузке страницы
         */
        function initializeGame() {
            loadGameState(); // Загружаем состояние игры из куки
            // Обновляем отображение фишек
            playerChipsSpan.textContent = playerChips;
            dealerChipsSpan.textContent = dealerChips;
            if (restrictionActive && restrictionEndTime) {
                const remainingTime = restrictionEndTime - Date.now();
                if (remainingTime > 0) {
                    showWaitingPage();
                } else {
                    restrictionActive = false;
                    lossCount = 0;
                    saveGameState();
                }
            }
        }
        
        /**
         * Функция для отображения страницы ожидания
         */
        function showWaitingPage() {
            document.getElementById('game-container').style.display = 'none';
            waitingPage.style.display = 'flex';
            restrictionActive = true;
            restrictionEndTime = Date.now() + 3 * 60 * 1000; // Текущее время + 3 минуты

            // Проверяем, есть ли сохраненное время начала ожидания
            const waitingStart = localStorage.getItem('waitingStartTime');
            let remainingTime = 180; // 3 минуты в секундах
            saveGameState();

            if (waitingStart) {
                const elapsed = Math.floor((Date.now() - parseInt(waitingStart)) / 1000);
                remainingTime = 180 - elapsed;
                if (remainingTime <= 0) {
                    // Время ожидания прошло
                    localStorage.removeItem('waitingStartTime');
                    countBankrupts = 0;
                    hideWaitingPage();
                    return;
                }
            } else {
                // Сохраняем текущее время начала ожидания
                localStorage.setItem('waitingStartTime', Date.now());
            }

            // Устанавливаем таймер
            const interval = setInterval(() => {
                remainingTime -= 1;
                if (remainingTime <= 0) {
                    clearInterval(interval);
                    localStorage.removeItem('waitingStartTime');
                    hideWaitingPage();
                }
                const minutes = Math.floor(remainingTime / 60).toString().padStart(2, '0');
                const seconds = (remainingTime % 60).toString().padStart(2, '0');
                timerDisplay.textContent = `Время осталось: ${minutes}:${seconds}`;
            }, 1000);
            
            x = Math.floor(Math.random()*13);
            factsDisplay.textContent = facts[x];
        }
        
        /**
         * Функция для скрытия страницы ожидания
         */
        function hideWaitingPage() {
            waitingPage.style.display = 'none';
            document.getElementById('game-container').style.display = 'block';
            lossCount = 0;
            saveGameState();
            messageDiv.textContent = 'Вы можете продолжить игру.';
        }

        /**
         * Функция для запуска начального состояния игры при загрузке страницы
         */
        window.onload = () => {
            initializeGame(); // Инициализируем игру
            levelSection.classList.remove('hidden'); // Показываем раздел выбора уровня сложности
            betSection.classList.add('hidden'); // Скрываем раздел ставок
            playerSection.classList.add('hidden'); // Скрываем раздел с картами игрока
            dealerSection.classList.add('hidden'); // Скрываем раздел с картами дилера
            controlsDiv.classList.add('hidden'); // Скрываем контролы игры
            
            displayLeaderboard();
        };
    </script>
</body>
</html>
