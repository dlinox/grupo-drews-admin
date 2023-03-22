import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";

import NProgress from "nprogress";
import { router } from "@inertiajs/vue3";


import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import "vue-advanced-cropper/dist/style.css";

import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";

import {
    NIcon,
    NConfigProvider,
    NDialogProvider,
    NLayout,
    NLayoutContent,
    NLayoutHeader,
    NLayoutSider,
    NMenu,
    NSpace,
    NDropdown,
    NButton,
    NForm,
    NFormItem,
    NAutoComplete,
    NInput,
    NImage,
    NSpin,
    NBreadcrumb,
    NBreadcrumbItem,
    NPageHeader,
    NAvatar,
    NDivider,
    NTable,
    NPopconfirm,
    NModal,
    NRow,
    NCol,
    NCard,
    NSelect,
    NGrid,
    NGridItem,
    NSwitch,
    NCarousel,
    NGi,
    NButtonGroup,
    NStatistic,
    NCollapse,
    NCollapseItem,
    NTabs,
    NTabPane,
    NDrawer,
    NDrawerContent,
    NInputNumber,
    NPagination
} from "naive-ui";

const options = {
    position: "top-right",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: false,
    closeButton: "button",
    icon: true,
    rtl: false,
};

router.on("start", () => NProgress.start());
router.on("finish", () => NProgress.done());

createInertiaApp({
    progress: {
        showSpinner: true,
        color: "#000",
    },
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            //.use(naive)
            .component("NIcon", NIcon)
            .component("NConfigProvider", NConfigProvider)
            .component("NDialogProvider", NDialogProvider)
            .component("NLayout", NLayout)
            .component("NLayoutContent", NLayoutContent)
            .component("NLayoutHeader", NLayoutHeader)
            .component("NLayoutSider", NLayoutSider)
            .component("NMenu", NMenu)
            .component("NSpace", NSpace)
            .component("NDropdown", NDropdown)
            .component("NButton", NButton)
            .component("NForm", NForm)
            .component("NFormItem", NFormItem)
            .component("NAutoComplete", NAutoComplete)
            .component("NInput", NInput)
            .component("NImage", NImage)
            .component("NSpin", NSpin)
            .component("NBreadcrumb", NBreadcrumb)
            .component("NBreadcrumbItem", NBreadcrumbItem)
            .component("NPageHeader", NPageHeader)
            .component("NAvatar", NAvatar)
            .component("NDivider", NDivider)
            .component("NTable", NTable)
            .component("NPopconfirm", NPopconfirm)
            .component("NModal", NModal)
            .component("NRow", NRow)
            .component("NCol", NCol)
            .component("NCard", NCard)
            .component("NSelect", NSelect)
            .component("NGrid", NGrid)
            .component("NGridItem", NGridItem)
            .component("NSwitch", NSwitch)
            .component("NCarousel", NCarousel)
            .component("NGi", NGi)
            .component("NButtonGroup", NButtonGroup)
            .component("NStatistic", NStatistic)
            .component("NCollapse", NCollapse)
            .component("NCollapseItem", NCollapseItem)
            .component("NTabs", NTabs)
            .component("NTabPane", NTabPane)
            .component("NDrawer", NDrawer)
            .component("NDrawerContent", NDrawerContent)
            .component("NInputNumber", NInputNumber)
            .component("NPagination", NPagination)

            
            .use(Toast, options)
            .use(plugin)
            .mount(el);
    },
});
