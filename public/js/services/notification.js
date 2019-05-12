const readAllNotifications = async () => {
  await readNotificationFor(esc(store.get('id')), res => {
    // $('.fa-bell').classList.remove('has-text-danger')
    $('#notificationsNumber').innerHTML = ''
  })
}

const showAllNotifications = async () => {
  let notifications = null
  await getNotificationsFor(esc(store.get('id')), res => {
    notifications = res
  })

  $('#notification').innerHTML = ''
  renderNotifications(notifications, 'append')
  if (notifications.length == 0) {
    $('#notification').innerHTML = `
      <div class="title has-text-centered no-notification">No New Notification</div>
    `
  }
}