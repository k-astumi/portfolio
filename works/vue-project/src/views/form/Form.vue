<template>
  <div class="container">
    <h1>Web問診票</h1>
    <FormInfoComponent
      @allData="updateData"
      v-show="stepNumber === 1"
    ></FormInfoComponent>
    <FormSymptomsComponent @symptoms="updateSymptoms" v-show="stepNumber === 2">
    </FormSymptomsComponent>
    <div class="result" v-show="stepNumber === 3">
      <p class="error" v-if="!isComplete">入力されていない項目があります</p>
      <p class="result__confirm">内容確認</p>
      <dl class="result__item">
        <dt class="result__title">診察券はお持ちですか？</dt>
        <dd class="result__data">{{ form.patientType }}</dd>
      </dl>
      <dl class="result__item" v-if="form.patientType === 'はい'">
        <dt class="result__title">診察番号</dt>
        <dd class="result__data">{{ form.patientNumber }}</dd>
      </dl>
      <dl class="result__item">
        <dt class="result__title">お名前</dt>
        <dd class="result__data">{{ form.name }}</dd>
      </dl>
      <dl class="result__item">
        <dt class="result__title">今回はどのような症状でお困りですか？</dt>
        <dd class="result__data">{{ form.symptoms }}</dd>
      </dl>
      <dl class="result__item">
        <dt class="result__title">
          薬・麻酔のアレルギーがありましたら、ご記入ください。
        </dt>
        <dd class="result__data">{{ form.allergy }}</dd>
      </dl>
    </div>
    <button class="button" @click="stepNumber--" v-if="stepNumber != 1">
      Back
    </button>
    <button class="button" @click="stepNumber++" v-if="stepNumber != 3">
      Next
    </button>
    <button
      class="button"
      :class="{ 'button--submit': isComplete }"
      :disabled="!isComplete"
      v-if="stepNumber === 3"
    >
      送信
    </button>
  </div>
</template>
<script setup lang="ts">
import { ref, watch } from "vue";
import FormInfoComponent from "@/views/form/FormInfo.vue";
import FormSymptomsComponent from "@/views/form/FormSymptoms.vue";
const stepNumber = ref(1);
const form = ref({
  patientType: "",
  patientNumber: "",
  name: "",
  symptoms: "",
  allergy: "",
});
const updateData = (formData: any) => {
  form.value.patientType = formData.patientType;
  form.value.patientNumber = formData.patientNumber;
  form.value.name = formData.name;
};
const updateSymptoms = (formData: any) => {
  form.value.symptoms = formData.symptoms;
  form.value.allergy = formData.allergy;
};
const isComplete = ref(false);
watch(form.value, () => {
  if (form.value.patientType === "はい") {
    if (
      form.value.patientNumber !== "" &&
      form.value.name !== "" &&
      form.value.symptoms !== "" &&
      form.value.allergy !== ""
    ) {
      isComplete.value = true;
    } else {
      isComplete.value = false;
    }
  } else {
    if (
      form.value.name !== "" &&
      form.value.symptoms !== "" &&
      form.value.allergy !== ""
    ) {
      isComplete.value = true;
    } else {
      isComplete.value = false;
    }
  }
});
</script>
<style lang="scss" scoped>
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 40px 16px;

  h1 {
    font-size: 28px;
  }

  .result {
    &__confirm {
      font-size: 22px;
    }
    &__title {
      //margin-top: 16px;
      line-height: 1;
      padding: 16px 0;
    }
    &__data {
      background-color: #eee;
      line-height: 1;
      min-height: calc(1em + 32px);
      padding: 16px;
    }
  }
}
.error {
  color: #db0c0c;
  background-color: #ffe4e4;
  border: 1px solid #db0c0c;
  padding: 8px;
  font-size: 12px;
  font-weight: bold;
  border-radius: 4px;
  margin: 8px 0;
}
.button {
  margin-top: 24px;
  background-color: #999;
  line-height: 1;
  text-align: center;
  width: 80px;
  height: 48px;
  border-radius: 5px;
  color: #fff;
  font-weight: bold;
  & + & {
    margin-left: 8px;
  }
  &.button--submit {
    background-color: #3fba84;
  }
}
</style>
