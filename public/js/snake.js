
    const playBoard = document.querySelector(".play-board");
    const scoreElement = document.querySelector(".score");
    const highScoreElement = document.querySelector(".high-score");
    const controls = document.querySelectorAll(".controls i");

    let gameOver = false;
    let foodX, foodY;
    let snakeX = 5, snakeY = 5;
    let velocityX = 0, velocityY = 0;
    let snakeBody = [];
    let setIntervalId;
    let score = 0;
    let gameStarted = false;

    let highScore = localStorage.getItem("high-score") || 0;
    highScoreElement.innerText = `High Score: ${highScore}`;

    const updateFoodPosition = () => {
        foodX = Math.floor(Math.random() * 30) + 1;
        foodY = Math.floor(Math.random() * 30) + 1;
    }

    const handleGameOver = () => {
        clearInterval(setIntervalId);
        alert("Game Over! Press OK to replay...");
        location.reload();
    }

    const changeDirection = e => {
        if(e.key === "ArrowUp" && velocityY != 1) {
            velocityX = 0;
            velocityY = -1;
        } else if(e.key === "ArrowDown" && velocityY != -1) {
            velocityX = 0;
            velocityY = 1;
        } else if(e.key === "ArrowLeft" && velocityX != 1) {
            velocityX = -1;
            velocityY = 0;
        } else if(e.key === "ArrowRight" && velocityX != -1) {
            velocityX = 1;
            velocityY = 0;
        }
    }
    controls.forEach(button => button.addEventListener("click", () => changeDirection({ key: button.dataset.key })));

    const startGame = () => {
        if (!gameStarted) {
            gameStarted = true;
            setIntervalId = setInterval(initGame, 100);
            // hide the start game instruction
            document.querySelector(".start-instructions").style.display = "none";
        }
    }

    const handleKeyPress = (e) => {
        if (!gameStarted) {
            startGame();
        }
        changeDirection(e);
    }

    const initGame = () => {
        if(gameOver) return handleGameOver();
        let html = `<div class="w-5 h-5" style="grid-area: ${foodY} / ${foodX};">
                        <img
                            src="https://pngfre.com/wp-content/uploads/apple-98-964x1024.png"
                            alt="Food"
                            class=""
                        >
                    </div>`;
        if(snakeX === foodX && snakeY === foodY) {
            updateFoodPosition();
            snakeBody.push([foodY, foodX]);
            score++;
            highScore = score >= highScore ? score : highScore;
            localStorage.setItem("high-score", highScore);
            scoreElement.innerText = `Score: ${score}`;
            highScoreElement.innerText = `High Score: ${highScore}`;
        }
        snakeX += velocityX;
        snakeY += velocityY;

        for (let i = snakeBody.length - 1; i > 0; i--) {
            snakeBody[i] = snakeBody[i - 1];
        }
        snakeBody[0] = [snakeX, snakeY];

        if(snakeX <= 0 || snakeX > 30 || snakeY <= 0 || snakeY > 30) {
            return gameOver = true;
        }

        for (let i = 0; i < snakeBody.length; i++) {
            html += `<div class="w-5 h-5" style="grid-area: ${snakeBody[i][1]} / ${snakeBody[i][0]}">
                        <img
                        src="../logo.png"
                            alt="Food"
                            class=""
                        >
                    </div>`;
            if (i !== 0 && snakeBody[0][1] === snakeBody[i][1] && snakeBody[0][0] === snakeBody[i][0]) {
                gameOver = true;
            }
        }
        playBoard.innerHTML = html;
    }

    // position of the snake and food before starting the game
    const showInitialPositions = () => {
        let html = `<div class="w-5 h-5" style="grid-area: ${snakeY} / ${snakeX};">
                        <img
                        src="../logo.png"
                            alt="Snake"
                            class=""
                        >
                    </div>`;

        html += `<div class="w-5 h-5" style="grid-area: ${foodY} / ${foodX};">
                    <img
                        src="https://pngfre.com/wp-content/uploads/apple-98-964x1024.png"
                        alt="Food"
                        class=""
                    >
                </div>`;

        playBoard.innerHTML = html;
    }

    updateFoodPosition();
    showInitialPositions();

    document.addEventListener("keyup", handleKeyPress);
