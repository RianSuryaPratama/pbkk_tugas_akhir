function showToast(selectedType, titleText, messageText) {
  const toastPlacementExample = document.querySelector('.toast-placement-ex');
  $("#titleText").html(titleText);
  $("#messageText").html(messageText);
  let selectedPlacement, toastPlacement;
  selectedPlacement = document.querySelector('#selectPlacement').value.split(' ');

  toastPlacementExample.classList.add(selectedType);
  DOMTokenList.prototype.add.apply(toastPlacementExample.classList, selectedPlacement);
  toastPlacement = new bootstrap.Toast(toastPlacementExample);
  toastPlacement.show();
}
function show_loading() {
  var elemenModalLoading = document.getElementsByClassName('modal-loading');
  var ModalBody = document.getElementsByClassName('modal-body');
  for (var i = 0; i < elemenModalLoading.length; i++) {
    elemenModalLoading[i].style.display = "block";
  }
  for (var i = 0; i < ModalBody.length; i++) {
    ModalBody[i].style.pointerEvents = "none";
    ModalBody[i].style.background = 'white';
    ModalBody[i].style.opacity = '0.4';
  }
}
function hide_loading() {
  var elemenModalLoading = document.getElementsByClassName('modal-loading');
  var ModalBody = document.getElementsByClassName('modal-body');
  for (var i = 0; i < elemenModalLoading.length; i++) {
    elemenModalLoading[i].style.display = "none";
  }
  for (var i = 0; i < ModalBody.length; i++) {
    ModalBody[i].style.pointerEvents = "auto";
    ModalBody[i].style.background = "transparent";
    ModalBody[i].style.opacity = '1';
  }
}
function formatTimeAgo(created_at) {
  const createdDate = new Date(created_at);
  const currentDate = new Date();
  const timeDifferenceInSeconds = Math.floor((currentDate - createdDate) / 1000);
  const minutesAgo = Math.floor(timeDifferenceInSeconds / 60);

  if (minutesAgo < 1) {
    return 'Baru saja';
  } else if (minutesAgo < 60) {
    return `${minutesAgo} menit yang lalu`;
  } else if (minutesAgo < 1440) {
    const hoursAgo = Math.floor(minutesAgo / 60);
    return `${hoursAgo} jam yang lalu`;
  } else {
    const daysAgo = Math.floor(minutesAgo / 1440);
    return `${daysAgo} hari yang lalu`;
  }
}