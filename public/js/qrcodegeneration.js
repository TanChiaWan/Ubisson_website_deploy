function process() {
    var url=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data==" + window.location.href;
    document.getElementById('QRCode').src = url;
}