import * as FilePond from 'filepond'
import zhCN from './locale/zh-cn'

import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginImagePreview from 'filepond-plugin-image-preview'

FilePond.setOptions({
  ...zhCN,
  credits: null
})

FilePond.registerPlugin(FilePondPluginFileValidateSize)
FilePond.registerPlugin(FilePondPluginFileValidateType)
FilePond.registerPlugin(FilePondPluginImagePreview)

window.FilePond = FilePond
