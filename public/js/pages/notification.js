window.addEventListener('load', () => {
  readAllNotifications()
  showAllNotifications()
})

setInterval(readAllNotifications, 15001)