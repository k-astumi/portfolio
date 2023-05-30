<template>
  <div class="form">
    <p class="title">診察券はお持ちですか？</p>
    <div class="checkbox-box">
      <input
        id="yes"
        type="radio"
        value="はい"
        v-model="patientType"
        @change="submitPatientInfo"
      />
      <label class="checkbox-label" for="yes">はい</label>
      <input
        id="no"
        type="radio"
        value="いいえ"
        v-model="patientType"
        @change="submitPatientInfo"
      />
      <label class="checkbox-label" for="no">いいえ</label>
      <input
        id="forget"
        type="radio"
        value="以前受診したことがあるが、不明"
        v-model="patientType"
        @change="submitPatientInfo"
      />
      <label class="checkbox-label" for="forget"
        >以前受診したことがあるが、不明</label
      >
    </div>

    <div class="patient-number" v-if="patientType === 'はい'">
      <label for="name" class="title">診察番号</label>
      <input
        type="number"
        class="form-text"
        v-model="patientNumber"
        @input="
          numberSlice();
          submitPatientInfo();
        "
        size="10"
      />
    </div>

    <label for="name" class="title">お名前</label>
    <input
      type="text"
      class="form-text"
      v-model="name"
      placeholder="山田太郎"
      size="30"
      @input="submitPatientInfo"
    />
  </div>
</template>
<script setup lang="ts">
import { ref } from "vue";
const patientType = ref("");
const patientNumber = ref("");
const name = ref("");

const emit = defineEmits<{
  (event: "allData", data: Object): void;
}>();
const submitPatientInfo = () => {
  emit("allData", {
    patientType: patientType.value,
    patientNumber: patientNumber.value,
    name: name.value,
  });
};
const numberSlice = () => {
  patientNumber.value = patientNumber.value.toString().slice(0, 7);
};
</script>
<style lang="scss" scoped>
.title {
  display: block;
  line-height: 1;
  padding: 16px 0;
  &:not(:first-of-type) {
    margin-top: 16px;
  }
}
.form-text {
  border: 1px solid #ccc;
  border-radius: 8px;
  padding: 4px 16px;
  box-sizing: border-box;
  max-width: 100%;
  & + & {
    margin-left: 8px;
  }
  &[type="number"]::-webkit-outer-spin-button,
  &[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
}
input[type="radio"] {
  display: none;
  &:checked + .checkbox-label {
    background-color: #3fba84;
    color: #fff;
    font-weight: bold;
  }
}
.checkbox-box {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.checkbox-label {
  display: inline-block;
  background-color: #eee;
  padding: 8px 16px;
  border-radius: 8px;
}
.patient-number {
  .title {
    margin-top: 16px;
  }
}
</style>
