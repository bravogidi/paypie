<!--<template>-->
<!--    <div>-->
<!--        <vue-numeric-input  v-model="value" :min="1" :max="10" :step="2"></vue-numeric-input>-->
<!--    </div>-->
<!--</template>-->

<template>
    <div>
        <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
        <input :id="id" ref="input" v-bind="$attrs" class="form-input" :class="{ error: error }" :type="type" :value="value" @input="$emit('input', $event.target.value)">
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props:{
        id: {
            type: Number,
            default() {
                return `numeric-input-${this._uid}`
            },
        },
        type: {
            type: Number,
            default: 1,
        },
        value: Number,
        label: Number,
        error: Number
    },
    methods: {
        focus() {
            this.$refs.input.focus()
        },
        select() {
            this.$refs.input.select()
        },
        setSelectionRange(start, end) {
            this.$refs.input.setSelectionRange(start, end)
        },
    },
};
</script>
