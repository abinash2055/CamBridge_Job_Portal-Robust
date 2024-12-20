import JobComponent from "./components/JobComponent";
import JobDistrict from "./components/JobDistrict";
import JobSalary from "./components/JobSalary";
import Organization from "./pages/Organization";
import JobCategory from "./pages/JobCategory";
import JobTitle from "./pages/JobTitle";

const routes = [
    {
        path: "/",
        component: JobComponent
    },
    {
        path: "/jobs-by-organization",
        component: Organization
    },
    {
        path: "/jobs-by-title",
        component: JobTitle
    },
    {
        path: "/jobs-by-category",
        component: JobCategory
    },
    {
        path: "/jobs-by-title",
        component: JobTitle
    },
    {
        path: "/jobs-by-category",
        component: JobCategory
    },
    {
        path: "/jobs-by-district",
        component: JobDistrict
    },
    {
        path: "/jobs-by-salary",
        component: JobSalary
    },
];
export default routes;
