<template>
    <div class="mt-1 w-full inline-flex items-center cursor-pointer">
        <span class="relative">
            <span class="block w-10 h-6 bg-gray-300 rounded-full shadow-inner" />
            <span
                :class="classList"
                class="absolute block w-4 h-4 mt-1 ml-1 rounded-full shadow inset-y-0 left-0 focus-within:shadow-outline transition-transform duration-300 ease-in-out"
            >
                <input
                    v-model="inputValue"
                    class="absolute opacity-0 w-0 h-0"
                    type="checkbox"
                />
            </span>
        </span>
        <span
            v-if="label"
            :class="color ? `text-${color}` : ''"
            class="ml-3 text-gray-500 text-sm"
            v-text="label"
        />
        <input
            :name="name"
            :value="submitValue"
            type="hidden"
        />
    </div>
</template>

<script lang="ts">
    export default {
        props: {
            name: {required: true, type: String},

            colorFalse: {default: null, required: false, type: String},

            colorTrue: {default: null, required: false, type: String},

            accent: {default: 'blue', required: false, type: String},

            labelFalse: {default: null, required: false, type: String},

            labelTrue: {default: null, required: false, type: String},

            value: {default: true, required: false, type: Number},
        },

        data(): object {
            return {
                inputValue: this.value,
            }
        },

        computed: {
            classList(): string {
                return this.inputValue ? `bg-${this.accent}-600 transform translate-x-full`:'bg-white'
            },

            color(): boolean {
                return this.inputValue ? this.colorTrue : this.colorFalse
            },

            label(): boolean {
                return this.inputValue ? this.labelTrue : this.labelFalse
            },

            submitValue(): number {
                return Number(this.inputValue)
            },
        },
    }
</script>
