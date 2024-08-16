import { Notification } from "@/Components/Notification";
import SideBar from "@/Components/SideBar";
import { setOpenSidenav, useNavigationController } from "@/Context";
import {PageProps, User} from "@/types";
import {
    Bars3Icon,
    ChevronDownIcon,
    HomeIcon,
    InboxArrowDownIcon,
    LifebuoyIcon,
    PowerIcon,
    UserCircleIcon,
    XCircleIcon,
    XMarkIcon,
} from "@heroicons/react/24/solid";
import { Link, router, usePage } from "@inertiajs/react";
import {
    Alert,
    Avatar,
    Breadcrumbs,
    Button,
    IconButton,
    Menu,
    MenuHandler,
    MenuItem,
    MenuList,
    Navbar,
    Typography,
} from "@material-tailwind/react";
import React, {PropsWithChildren, ReactNode, useState} from "react";

const profileMenuItems = [
    {
        label: "My Profile",
        icon: UserCircleIcon,
        link: "/profile",
    },
    {
        label: "Inbox",
        icon: InboxArrowDownIcon,
        link: "#",
    },
    {
        label: "Help",
        icon: LifebuoyIcon,
        link: "#",
    },
    {
        label: "Sign Out",
        icon: PowerIcon,
        link: "/logout",
    },
];

export default function Authenticated({ user, header, children }: PropsWithChildren<{ user: User, header?: ReactNode }>) {
    const { controller, dispatch } = useNavigationController();
    const { openSidenav } = controller;

    const { errors, flash, breadcrumbs, auth } = usePage<PageProps>().props;

    const [open, setOpen] = useState(true);
    const [isMenuOpen, setIsMenuOpen] = useState(false);

    const closeMenu = () => setIsMenuOpen(false);
    const handleMenuClick = ({
        link,
        label,
    }: {
        link: string;
        label: string;
    }) => {
        closeMenu();
        if (label === "Sign Out") {
            router.post(link);
            return;
        }
        router.get(link);
    };

    let currentLink = "";
    // const crumbsLink = breadcrumbs
    //     .split("/")
    //     .filter((crumb: string) => crumb !== "")
    //     .map((crumb: string | number | boolean | React.ReactElement<any, string | React.JSXElementConstructor<any>> | Iterable<React.ReactNode> | React.ReactPortal | null | undefined, index: React.Key | null | undefined) => {
    //         currentLink += `/${crumb}`;
    //         return (
    //             <Link key={index} href={currentLink}>
    //                 {crumb}
    //             </Link>
    //         );
    //     });

    return (
        <div className="min-h-screen bg-blue-gray-50/50">
            <SideBar user={auth.user} />

            <div className="p-4 xl:ml-80">
                <div className="mb-8 space-y-4">
                    <Navbar
                        className="rounded-xl shadow-md transition-all duration-300"
                        fullWidth
                        shadow={false}
                        blurred={false}
                    >
                        <div className={`flex items-center justify-end gap-4`}>
                            <IconButton
                                className="bg-blue-gray-50/50 text-gray-600 hover:text-gray-600 xl:hidden"
                                variant="text"
                                onClick={() =>
                                    setOpenSidenav(dispatch, !openSidenav)
                                }
                            >
                                {openSidenav ? (
                                    <XMarkIcon className="h-6 w-6" />
                                ) : (
                                    <Bars3Icon className="h-6 w-6" />
                                )}
                            </IconButton>

                            <div className="flex items-center">
                                {auth.user === null ? (
                                    <div className="flex items-center gap-4">
                                        <Link href={route("login")}>
                                            <Button size="sm" color="blue-gray">
                                                Login
                                            </Button>
                                        </Link>
                                    </div>
                                ) : (
                                    <Menu
                                        open={isMenuOpen}
                                        handler={setIsMenuOpen}
                                        placement="bottom-end"
                                    >
                                        <MenuHandler>
                                            <Button
                                                variant="text"
                                                color="blue-gray"
                                                className="flex items-center gap-2 rounded-full py-0.5 pl-0.5 pr-2 lg:ml-auto"
                                            >
                                                <Avatar
                                                    variant="circular"
                                                    size="sm"
                                                    alt={auth.user.name}
                                                    className="border border-blue-500 p-0.5"
                                                    src={
                                                        auth.user.media?.[0]
                                                            .original_url
                                                    }
                                                />
                                                <div className="flex flex-col items-start justify-start">
                                                    <Typography
                                                        variant="lead"
                                                        className="text-[10px] font-bold"
                                                    >
                                                        {auth.user.name}
                                                    </Typography>
                                                    <Typography
                                                        variant="lead"
                                                        className="text-[10px]"
                                                    >
                                                        role
                                                        {/*{*/}
                                                        {/*    auth.user.roles[0]*/}
                                                        {/*        .name*/}
                                                        {/*}*/}
                                                    </Typography>
                                                </div>
                                                <ChevronDownIcon
                                                    strokeWidth={2.5}
                                                    className={`h-3 w-3 transition-transform ${
                                                        isMenuOpen
                                                            ? "rotate-180"
                                                            : ""
                                                    }`}
                                                />
                                            </Button>
                                        </MenuHandler>
                                        <MenuList className="p-1">
                                            {profileMenuItems.map(
                                                (
                                                    { label, icon, link },
                                                    key,
                                                ) => {
                                                    const isLastItem =
                                                        key ===
                                                        profileMenuItems.length -
                                                            1;
                                                    return (
                                                        <MenuItem
                                                            key={label}
                                                            onClick={() =>
                                                                handleMenuClick(
                                                                    {
                                                                        link,
                                                                        label,
                                                                    },
                                                                )
                                                            }
                                                            className={`flex items-center gap-2 rounded ${
                                                                isLastItem
                                                                    ? "hover:bg-red-500/10 focus:bg-red-500/10 active:bg-red-500/10"
                                                                    : ""
                                                            }`}
                                                        >
                                                            {React.createElement(
                                                                icon,
                                                                {
                                                                    className: `h-4 w-4 ${
                                                                        isLastItem
                                                                            ? "text-red-500"
                                                                            : ""
                                                                    }`,
                                                                    strokeWidth: 2,
                                                                },
                                                            )}
                                                            <Typography
                                                                as="span"
                                                                variant="small"
                                                                className="font-normal"
                                                                color={
                                                                    isLastItem
                                                                        ? "red"
                                                                        : "inherit"
                                                                }
                                                            >
                                                                {label}
                                                            </Typography>
                                                        </MenuItem>
                                                    );
                                                },
                                            )}
                                        </MenuList>
                                    </Menu>
                                )}
                            </div>
                        </div>
                    </Navbar>

                    <Breadcrumbs
                        color="blue-gray"
                        className="bg-transparent px-0"
                    >
                        <Link href="/">
                            <IconButton variant="text" color="blue-gray">
                                <HomeIcon className="h-5 w-5" />
                            </IconButton>
                        </Link>
                    </Breadcrumbs>

                    {/*
                     * validation error alert
                     */}
                    {Object.keys(errors).length !== 0 && (
                        <Alert
                            open={open}
                            color="red"
                            icon={<XCircleIcon className="mt-px h-6 w-6" />}
                            onClose={() => setOpen(false)}
                        >
                            <Typography className="font-medium">
                                Validation Error Occurred!
                            </Typography>
                            <ul className="ml-2 mt-2 list-inside list-disc">
                                {Object.keys(errors).map((key) => (
                                    <li key={key}>{errors[key]}</li>
                                ))}
                            </ul>
                        </Alert>
                    )}

                    {/*
                     * flash message alert
                     */}
                    {/*{flash.status !== null && flash.message !== null && (*/}
                    {/*    <Notification*/}
                    {/*        message={flash.message}*/}
                    {/*        status={flash.status}*/}
                    {/*    />*/}
                    {/*)}*/}
                </div>
                <main>{children}</main>
                <footer className="mt-8 flex items-center justify-center gap-2 p-4">
                    <Typography variant="small" color="blue-gray">
                        &copy; 2022 - 2023
                    </Typography>
                    <Typography variant="small" color="blue-gray">
                        All rights reserved
                    </Typography>
                </footer>
            </div>
        </div>
    );
}
