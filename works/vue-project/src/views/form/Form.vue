<template>
  <div
    class="info-button"
    @click="
      openModal();
      showContent = true;
    "
  >
    <img src="/icon_info_gray.svg" alt="" />
    <p class="info-button__text">このページの情報</p>
  </div>
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
  <ModalInfoComponent
    v-if="showContent"
    @close="
      closeModal();
      showContent = false;
    "
    >こちらのページはTO
    DOリストアプリと同じく、ChatGPTにVue.jsでwebページを作るならどんなものが良いか、アイデアを聞いて実際に作ったページです。<br />
    フォーム入力部分は子コンポーネントに分けて、子コンポーネントに入力されたデータはemitで親コンポーネントに渡し、リアルタイムで入力情報確認ができるようになっています。<br />
    「診察券はお持ちですか？」の部分ではv-modelを使ってチェックボックスの値によって表示されるフォームの切り替えも行なっています。<br />
    また、ウォッチャーを使用してデータが更新されるたびにバリデーションをおこない、入力されていない項目が存在する場合はリアルタイムにエラーが出て、送信ボタンが非活性になるようにしました。
  </ModalInfoComponent>
</template>
<script setup lang="ts">
import { ref, watch } from "vue";
import FormInfoComponent from "@/views/form/FormInfo.vue";
import FormSymptomsComponent from "@/views/form/FormSymptoms.vue";
import ModalInfoComponent from "@/components/ModalInfo.vue";
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
//モーダル
const showContent = ref(false);
const openModal = () => {
  document.body.classList.add("is-locked");
};
const closeModal = () => {
  document.body.classList.remove("is-locked");
};
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
