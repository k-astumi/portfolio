<template>
  <div class="form">
    <p class="title">今回はどのような症状でお困りですか？</p>
    <textarea
      class="text-area"
      id=""
      cols="30"
      rows="5"
      v-model="symptoms"
      @input="submitSymptoms"
    ></textarea>
    <p class="title">薬・麻酔のアレルギーがありましたら、ご記入ください。</p>
    <textarea
      class="text-area"
      id=""
      cols="30"
      rows="5"
      v-model="allergy"
      @input="submitSymptoms"
    ></textarea>
  </div>
</template>
<script setup lang="ts">
import { ref } from "vue";
const symptoms = ref("");
const allergy = ref("");
const emit = defineEmits<{
  (event: "symptoms", data: Object): void;
}>();
const submitSymptoms = () => {
  emit("symptoms", {
    symptoms: symptoms.value,
    allergy: allergy.value,
  });
};
</script>
<style lang="scss" scoped>
.title {
  padding: 16px 0;
}
.text-area {
  border: 1px solid #ccc;
  border-radius: 8px;
  resize: none;
  width: 100%;
  padding: 8px;
  & + .title {
    margin-top: 16px;
  }
}
</style>
