import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import React from "react";

export default function Home() {
  return (
    <AuthenticatedLayout>
      <Head title="Home" />
      <div className="mt-4 space-y-8">
        <div className="grid gap-8 lg:grid-cols-3">
            <div>hello world</div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}
