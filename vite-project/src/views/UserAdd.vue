<!-- ユーザー登録 -->
<template>
    <div class="page">
        <div class="top_container">
            <button @click="goBack" class="button left_icon gray">
                <span class="material-symbols-outlined">first_page</span>
                <span class="name">戻る</span>
            </button>
            <button @click="addUserHandler" class="button left_icon blue" :disabled="!isInitialized">
                <span class="material-symbols-outlined">add</span>
                <span class="name">追加</span>
            </button>
        </div>
        <div class="input_container">
            <div class="row error">
                <ErrorMessageManager :errorMessagesList="errorMessagesList" />
            </div>
            <div class="row">
                <div class="item">
                    <div class="label required">{{ tableInfos.user.username.name }}</div>
                    <div>
                        <input ref="usernameInput" type="text" class="input"
                            :class="{ error: isUsernameError }" v-model="username" :maxlength="tableInfos.user.username.length"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="item">
                    <div class="label required">{{ tableInfos.user.password.name }}</div>
                    <div>
                        <input ref="passwordInput" type="password" class="input"
                            :class="{ error: isPasswordError }" v-model="password" :maxlength="tableInfos.user.password.length"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="item">
                    <div class="label required">{{ tableInfos.user.name.name }}</div>
                    <div>
                        <input ref="nameInput" type="text" class="input"
                            :class="{ error: isNameError }" v-model="name" :maxlength="tableInfos.user.name.length"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="item">
                    <div class="label required">{{ tableInfos.roleCodes.name }}</div>
                    <!-- ラジオボタンを動的に生成 -->
                    <div class="radio_container">
                        <div v-for="role in roleCodesStore.roleCodes" :key="role.id" class="radio">
                            <input type="radio" :id="`role-${role.id}`" name="roles" :value="role.id" v-model="selectedRole"/>
                            <label :for="`role-${role.id}`">{{ role.name }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="item">
                    <div class="label">{{ tableInfos.user.email.name }}</div>
                    <div>
                        <input ref="emailInput" type="email" class="input email"
                            :class="{ error: isEmailError }" v-model="email" :maxlength="tableInfos.user.email.length"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { defineEmits, onMounted, ref, inject, nextTick} from 'vue';
    import type { Ref } from 'vue';
    import { useRouter } from 'vue-router';
    import { useRoleCodeStore } from '../stores/roleCodes';
    import { useUsersStore } from '../stores/users';
    import { completedStore } from '../stores/completedStore';
    import { isLoadingKey } from '../keys';
    import { validateAlphanumericWithSymbols, validateEmailFormat, validatePassword } from '../utils/validators';
    import { errorMessages } from '../messages/errorMessages';
    import { tableInfos } from '../constants/tableInfos';
    import ErrorMessageManager from '../components/message/ErrorMessageManager.vue';

    // ページ名
    const PAGE_NAME = 'ユーザー追加';
    // ページ名横に表示するアイコンの名称
    const PAGE_ICON_NAME = 'add';

    // 'send-message' イベントを定義
    const emit = defineEmits<{
        (event: 'send-message', data: { pageName: string, pageIconName: string }): void;
    }>();

    // ルーターのインスタンスを取得
    const router = useRouter();

    // `isLoading` を inject
    const isLoading = inject(isLoadingKey) as Ref<boolean>;

    // ストアのインスタンスを作成
    const roleCodesStore = useRoleCodeStore();
    const usersStore = useUsersStore();

    // 入力項目を取得
    const username = ref('');
    const password = ref('');
    const name = ref('');
    const email = ref('');
    
    // エラーメッセージリスト
    const errorMessagesList = ref<string[]>([]);

    // 入力項目のエラー状態を示すref
    const isUsernameError = ref(false);
    const isPasswordError = ref(false);
    const isNameError = ref(false);
    const isEmailError = ref(false);

    // refでinput要素を参照
    const usernameInput = ref<HTMLInputElement | null>(null);
    const passwordInput = ref<HTMLInputElement | null>(null);
    const nameInput = ref<HTMLInputElement | null>(null);
    const emailInput = ref<HTMLInputElement | null>(null);

    // 初期値を役割コードがあればその最初のものに設定
    const selectedRole = ref<number>(roleCodesStore.roleCodes && roleCodesStore.roleCodes.length > 0 ? roleCodesStore.roleCodes[0].id : tableInfos.roleCodes.user);

    // 初期化処理の成功状態
    const isInitialized = ref(false);
    
    /**
     * 初期化処理
     */
    const initialize = async () => {
        // 親コンポーネントにページ名とアイコン名を送信
        emit('send-message', { pageName: PAGE_NAME, pageIconName: PAGE_ICON_NAME });

        // ローディング開始
        if (isLoading) isLoading.value = true;

        try {
            // 役割コードを取得
            await roleCodesStore.fetchRoleCodes(); // 非同期に役割コードを取得

            // データの読み込みが完了したら、loadingがfalseになっているか確認
            if (roleCodesStore.roleCodes && roleCodesStore.roleCodes.length > 0) {
                // 最初の役割を選択
                selectedRole.value = roleCodesStore.roleCodes[0].id;
            }

            // 初期化成功時
            isInitialized.value = true;
        } catch (error: any) {
            console.error('役割コードの取得に失敗:', error);
            errorMessagesList.value.push('役割コードの取得に失敗しました。再試行してください。');

            // 初期化失敗時
            isInitialized.value = false;
        } finally {
            // ローディング終了
            if (isLoading) isLoading.value = false;
        }
    };

    /**
     * 入力項目を検証する関数
     * 
     * - 必須項目のチェックを行い、未入力の場合や形式が不正な場合にエラーメッセージを返します。
     * - ユーザー名の形式チェック（半角英数字と記号）も行います。
     * - 各入力項目について、エラーがあればそのエラーメッセージを配列として返します。
     * 
     * @returns {object} エラーメッセージの配列と、各項目のエラー状態を含むオブジェクト
     */
    const validateRequiredFields = (): { errors: string[], fieldErrors: { [key: string]: boolean } } => {
        const errors: string[] = [];
        const fieldErrors: { [key: string]: boolean } = {};

        // ユーザー名の検証
        fieldErrors.username = !username.value || !validateAlphanumericWithSymbols(username.value);
        if (!username.value) {
            errors.push(errorMessages.requiredField(tableInfos.user.username.name)); // ユーザー名が未入力の場合
        } else if (fieldErrors.username) {
            errors.push(errorMessages.invalidCharacterFormat(tableInfos.user.username.name)); // ユーザー名に不正な文字が含まれている場合
        }

        // パスワードの検証
        fieldErrors.password = !password.value || !validatePassword(password.value);
        if (!password.value) {
            errors.push(errorMessages.requiredField(tableInfos.user.password.name)); // パスワードが未入力の場合
        } else if (fieldErrors.password) {
            errors.push(errorMessages.invalidPasswordFormat); // パスワードが無効な形式の場合
        }

        // 名前の検証
        fieldErrors.name = !name.value;
        if (fieldErrors.name) {
            errors.push(errorMessages.requiredField(tableInfos.user.name.name)); // 名前が未入力の場合
        }

        // メールアドレスの検証
        fieldErrors.email = email.value.trim() !== '' && !validateEmailFormat(email.value);
        if (fieldErrors.email) {
            errors.push(errorMessages.invalidFormat(tableInfos.user.email.name)); // メールアドレスが不正な形式の場合
        }

        return { errors, fieldErrors };
    };

    /**
     * コンポーネントがマウントされた際に、初期化処理を実行する
     * 
     * `onMounted` はコンポーネントが DOM にマウントされた後に呼ばれるライフサイクルフックです。
     * このフック内で `initialize` 関数を呼び出すことで、コンポーネントが表示されるタイミングで
     * 初期化処理が行われます。例えば、ページ名やアイコン名の送信、API呼び出しなどが含まれます。
     */
    onMounted(() => {
        // コンポーネントが画面に表示された際に、初期化処理を呼び出して実行する
        initialize(); // 初期化処理を実行
    });

    /**
     * ユーザーを追加する処理
     * 
     * - 項目の入力チェックを行う
     * - チェックが通れば、ユーザー情報をAPIに送信
     */
    const addUserHandler = async () => {
        // ローディング開始
        if (isLoading) isLoading.value = true;

        try {
            // 入力チェックを行い、エラーメッセージがあれば表示
            const { errors, fieldErrors } = validateRequiredFields();
            errorMessagesList.value = errors;

            // エラーフィールドにフォーカス
            nextTick(() => {
                if (fieldErrors.username) {
                    usernameInput.value?.focus();
                } else if (fieldErrors.password) {
                    passwordInput.value?.focus();
                } else if (fieldErrors.name) {
                    nameInput.value?.focus();
                } else if (fieldErrors.email) {
                    emailInput.value?.focus();
                }
            });

            // エラーがなければユーザーを追加
            if (errors.length === 0) {
                const newUser = {
                    username: username.value,
                    password: password.value,
                    name: name.value,
                    email: email.value,
                    role_code_id: selectedRole.value
                };

                const user = await usersStore.addUser(newUser); // ユーザー追加APIを呼び出し

                // ユーザー追加成功後の処理
                console.log('ユーザーが追加されました:', user);

                // ユーザー登録成功時にモーダルを表示
                completedStore.showCompleted('新規ユーザーが追加されました。', undefined, undefined, undefined, undefined, onComplete);
            }
        } catch (error: any) {
            console.error('ユーザー追加失敗:', error);

            // ユーザー登録失敗時にエラーメッセージを表示
            if (error.response && error.response.data && error.response.data.message) {
                errorMessagesList.value.push(error.response.data.message);
            } else {
                errorMessagesList.value.push('ユーザーの登録に失敗しました。もう一度お試しください。');
            }
        } finally {
            // ローディング終了
            if (isLoading) isLoading.value = false;
        }
    };

    /**
     * 完了ボタンクリック時の処理
     * 
     * この関数は完了ボタンがクリックされた際に呼び出され、ユーザー一覧ページに遷移します。
     * 遷移先の URL は '/user' となっていますが、必要に応じて適切な URL に変更してください。
     * 
     * @returns {void}
     */
    const onComplete = () => {
        // 追加後にユーザー一覧ページへ遷移（適切なURLに変更
        router.push('/user');
    };

    /**
     * 戻るボタンをクリックしたときの処理
     * - ルーターを使って前のページに戻る
     */
    const goBack = () => {
        // 前ページへ戻る
        router.back();
    };

</script>

<style scoped>
    /* ページ上部のコンテナー */
    .top_container {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
    }

    /* 入力用のコンテナー */
    .input_container {
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding: 15px;
        width: 650px;
    }
    /* 入力用のコンテナーの行内の入力項目を内包するコンテナー */
    .input_container .row .item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    /* エラーメッセージ表示用のコンテナー */
    .input_container .row.error {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* ラジオボタン表示用のコンテナー */
    .radio_container {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* メールアドレス入力欄 */
    .input.email { width: 100%; }
</style>