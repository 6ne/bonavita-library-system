const readAllNotifications = async () => {
  await readNotificationFor(esc(store.get('id')), res => {
    $('.fa-bell').classList.remove('has-text-danger')
    $('#notificationsNumber').innerHTML = ''
  })
}

const showAllNotifications = async () => {
  let notifications = null
  await getNotificationsFor(esc(store.get('id')), res => {
    notifications = res
  })

  $('main.container').innerHTML = ''
  renderNotifications(notifications, 'append')
  if (notifications.length == 0) {
    $('main.container').innerHTML = `
      <div class="has-text-centered title">No New Notifications</div>
    `
  }
}