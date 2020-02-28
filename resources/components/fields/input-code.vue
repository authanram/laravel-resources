<template>
    <div
        :class="{ 'readonly': readOnly }"
        class="vcode"
    >
        <textarea
            :ref="name"
            :name="name"
            v-text="value"
        />
    </div>
</template>

<script>
    export default {
        props: {
            debug: {
                default: false,
                type: Boolean,
            },
            htmlMode: {
                default: false,
                type: Boolean,
            },
            json: {
                default: false,
                type: Boolean,
            },
            lineNumbers: {
                default: true,
                type: Boolean,
            },
            mode: {
                default: 'application/javascript',
                type: String,
            },
            name: {
                default: 'code',
                type: String,
            },
            readOnly: {
                default: true,
                type: Boolean,
            }
        },

        computed: {
            slots () {
                return this.$slots
            },
            value () {
                const value = (this.slots.default ? this.slots.default[0].text : '')

                return this.json
                    ? JSON.parse(value)
                    : value
            },
        },

        methods: {
            _debug () {
                console.log('htmlMode', this.htmlMode)
                console.log('json', this.json)
                console.log('mode', this.mode)
                console.log('---')
            },
        },

        mounted () {
            CodeMirror.fromTextArea(
                this.$refs[this.name],
                {
                    htmlMode: this.htmlMode,
                    indentWithTabs: false,
                    json: this.json,
                    lineNumbers: this.lineNumbers,
                    mode: this.mode,
                    readOnly: this.readOnly,
                    styleActiveLine: true,
                    theme: 'default',
                }
            );

            if (!this.debug) {
                return
            }

            this._debug()
        },
    }
</script>
