<template>
    <div class="input-group my-1">
        <div class="input-group-prepend">
            <span class="input-group-text">{{ label }}</span>
        </div>
        <input :type="type" class="form-control"
            v-on:input="$emit('input', $event.target.value)"
            :class="{'is-valid':!validator.$error && validator.$dirty,
             'is-invalid':validator.$error}"
        >
    </div>
</template>
<script>
export default {
    props: {
        label: {
            type: String,
            required: true
        },
        type: {
            type: String,
            required: true,
            validator(value) {
                return ['text', 'email'].includes(value);
            }
        },
        validator: {
            type: Object,
            required: true
        },
        value: {
            type: String,
            required: true
        }
    }
}
</script>