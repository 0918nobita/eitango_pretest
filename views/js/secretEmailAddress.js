// メールアドレスを直接HTMLに書かずに、JavaScript側で埋め込み表示するようにしてスパム対策をしている

function secretEmailAddress() {
    var ma = String.fromCharCode(110, 111, 98, 105, 116, 97, 46, 48, 57, 49, 56, 64, 103, 109, 97, 105, 108, 46, 99, 111, 109);
    var mt = String.fromCharCode(109,97,105,108,116,111,58);
    document.write('<a href="'+ mt + ma + '">こちら</a>');
}
