
document.addEventListener('DOMContentLoaded', function () {
  // 📢 Start the advertisement message typing loop
  const messages = [
    "Choose a bundle",
    "enter your phone number",
    "you will receive a prompt, enter mpesa pin",
    "and you will be connected",
    "if you have a problem please contact us"
  ];

  let msgIndex = 0;

  function typeMessage(message, element, callback) {
    let charIndex = 0;
    element.textContent = '';

    const typer = setInterval(() => {
      element.textContent += message[charIndex];
      charIndex++;

      if (charIndex >= message.length) {
        clearInterval(typer);
        setTimeout(callback, 2000);
      }
    }, 100);
  }

  function showMessagesLoop() {
    const display = document.getElementById('advertisments');
    typeMessage(messages[msgIndex], display, () => {
      msgIndex = (msgIndex + 1) % messages.length;
      showMessagesLoop();
    });
  }

  showMessagesLoop();

  // 💡 BUY BUTTON + POPOVER LOGIC WITH OVERLAY
  const buyButtons = document.querySelectorAll('.buy-btn');

  buyButtons.forEach(button => {
    button.addEventListener('click', () => {
      const speed = button.dataset.speed;
      const duration = button.dataset.duration;
      const price = button.dataset.price;

      document.getElementById('pop-speed').textContent = speed;
      document.getElementById('pop-duration').textContent = duration;
      document.getElementById('pop-price').textContent = price;

      // Show popover and overlay
      document.getElementById('popover').style.display = 'block';
      document.getElementById('overlay').style.display = 'block';
    });
  });

  // 👋 Close popover and hide overlay
  window.closePopover = function () {
    document.getElementById('popover').style.display = 'none';
    document.getElementById('overlay').style.display = 'none';
  };
});

