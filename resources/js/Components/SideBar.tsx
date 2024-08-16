import { setOpenSidenav, useNavigationController } from "@/Context";
import { User } from "@/types";
import {
  AcademicCapIcon,
  BookOpenIcon,
  ChatBubbleLeftRightIcon,
  ClipboardDocumentCheckIcon,
  ClipboardDocumentListIcon,
  DocumentCheckIcon,
  HomeIcon,
  MagnifyingGlassIcon,
  PowerIcon,
  UserCircleIcon,
  XMarkIcon,
} from "@heroicons/react/24/solid";
import { Link, router } from "@inertiajs/react";
import {
  Avatar,
  Card,
  IconButton,
  Input,
  List,
  ListItem,
  ListItemPrefix,
  Typography,
} from "@material-tailwind/react";

export default function SideBar({ user }: { user: User }) {
  const { controller, dispatch } = useNavigationController();

  const { openSidenav } = controller;

  const MenuItems = () => {
    const commonItems = [
      {
        label: "Home",
        icon: HomeIcon,
        routeName: "dashboard",
      },
      {
        label: "Courses",
        icon: BookOpenIcon,
        routeName: "courses.index",
      },
      {
        label: "Assignments",
        icon: ClipboardDocumentCheckIcon,
        routeName: "assignments.index",
      },
      {
        label: "Quiz",
        icon: ClipboardDocumentListIcon,
        routeName: "quizzes.index",
      },
      {
        label: "Grades",
        icon: AcademicCapIcon,
        routeName: "grades.index",
      },
      {
        label: "Forums",
        icon: ChatBubbleLeftRightIcon,
        routeName: "forums.index",
      },
    ];

    // if (user?.role === "teacher") {
    //   return [
    //     ...commonItems,
    //     {
    //       label: "Assessments",
    //       icon: DocumentCheckIcon,
    //       routeName: "submission.index",
    //     },
    //   ];
    // }

    return commonItems;
  };

  const MenuSettings = [
    {
      label: "Profile",
      icon: UserCircleIcon,
      routeName: "profile.edit",
    },
    {
      label: "Logout",
      icon: PowerIcon,
      routeName: "logout",
    },
  ];

  const handleMenuClick = (routeName: string) => {
    if (routeName === "logout") {
      router.post(route(routeName));
    }
    router.get(route(routeName));
  };

  return (
    <aside
      className={`${
        openSidenav ? "translate-x-0" : "-translate-x-80"
      } fixed inset-0 z-50 my-4 ml-4 h-[calc(100vh-32px)] w-72 rounded-xl transition-transform duration-300 xl:translate-x-0`}
    >
      <Card className="h-full p-4">
        <div className="flex justify-end">
          <IconButton
            className="bg-blue-gray-50/50 text-gray-600 hover:text-gray-600 xl:hidden"
            variant="text"
            onClick={() => setOpenSidenav(dispatch, !openSidenav)}
          >
            <XMarkIcon className="h-5 w-5" />
          </IconButton>
        </div>
        <div className="flex shrink-0 items-center justify-center">
          <Link href="/">
            <div className="flex items-center gap-4 p-4">
              <AcademicCapIcon className="h-8 w-8" />
              <Typography variant="lead" color="blue-gray">
                E-Learning
              </Typography>
            </div>
          </Link>
        </div>

        <hr className="my-2 border-blue-gray-50" />

        <div className="p-2">
          <Input
              icon={<MagnifyingGlassIcon className="h-5 w-5"/>}
              label="Search" crossOrigin={undefined}          />
        </div>

      </Card>
    </aside>
  );
}
