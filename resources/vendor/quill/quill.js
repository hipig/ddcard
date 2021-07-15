import Quill from 'quill'
import ImageBlot from "./components/ImageBlot"
import DividerBlot from "./components/DividerBlot"
import HTMLBlot from "./components/HTMLBlot"
import Clipboard from "./components/Clipboard"
import Link from "./components/Link"

let icons

Quill.register(ImageBlot, true);
Quill.register(DividerBlot, true);
Quill.register(HTMLBlot, true);
Quill.register(Link, true);
Quill.register('modules/clipboard', Clipboard, true)

icons = Quill.import('ui/icons');
icons.header[3] = require('!html-loader!quill/assets/icons/header-3.svg')

window.Quill = Quill
