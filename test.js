document.addEventListener("DOMContentLoaded", function () {
    const startButton = document.getElementById("startButton");
    const gameArea = document.getElementById("gameArea");

    startButton.addEventListener("click", function () {
        startButton.style.display = "none";
        gameArea.style.display = "block";
        startGame();
    });

    function startGame() {
        // 게임 로직을 이곳에 추가하세요.
        // 예를 들어, 게임 화면 생성, 게임 루프 설정, 이벤트 처리 등.
    }
});
