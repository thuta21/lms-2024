export interface User {
  id: number;
  name: string;
  email: string;
  email_verified_at: string;
  avatar: string;
  roles: Array<Role>;
  media?: Media[];
}

export interface Role {
  name: string;
}

export interface Category {
  id: number;
  name: string;
  slug: string;
  created_at: string;
  updated_at: string;
}

export interface Course {
  id: number;
  title: string;
  slug: string;
  description: string;
  image: string;
  user_id: number;
  user: User;
  category: Category;
  category_id: number;
  created_at: string;
  updated_at: string;
  modules?: Module[];
  assignments?: Assignment[];
  media?: Media[];
  quizzes?: Quiz[];
  grades?: Grade[];
  forum?: Forum;
  enrollments_count?: number;
}

export interface Module {
  id: number;
  name: string;
  description: string;
  content: string;
  order_number: number;
  course_id: number;
  created_at: string;
  updated_at: string;
}

export interface Assignment {
  id: number;
  name: string;
  description: string;
  due_date: string;
  total_marks: number;
  course_id: number;
  grades?: Grade[];
  submissions?: Submission[];
  created_at: string;
  updated_at: string;
}

export interface Quiz {
  id: number;
  name: string;
  total_marks: number;
  course_id: number;
  questions?: Question[];
  attempts?: Attempt[];
  created_at: string;
  updated_at: string;
}

export interface Question {
  id: number;
  question: string;
  options: [] | Option[];
  correct_answer: string;
  quiz_id: number;
}

export interface Option {
  key: string;
  value: string;
}

export interface Enrollment {
  id: number;
  user_id: number;
  course_id: number;
  course: Course;
  created_at: string;
  updated_at: string;
}

export interface Grade {
  id: number;
  user_id: number;
  course_id: number;
  gradeable_id: number;
  gradeable_type: string;
  course: Course;
  score: number;
  created_at: string;
  updated_at: string;
}

export interface Submission {
  id: number;
  user_id: number;
  assignment_id: number;
  submission_file: string;
  user: User;
  created_at: string;
  updated_at: string;
}

export interface Attempt {
  id: number;
  user_id: number;
  quiz_id: number;
}

export interface Forum {
  id: number;
  title: string;
  description: string;
  user_id: number;
  course_id: number;
  created_at: string;
  updated_at: string;
  threads?: Thread[];
  threads_count?: number;
  user: User;
  course: Course;
}

export interface Thread {
  id: number;
  title: string;
  content: string;
  user_id: number;
  forum_id: number;
  created_at: string;
  updated_at: string;
  user: User;
  forum: Forum;
  posts?: Post[];
  posts_count?: number;
}

export interface Post {
  id: number;
  content: string;
  user_id: number;
  thread_id: number;
  created_at: string;
  updated_at: string;
  user: User;
  thread: Thread;
}

export interface Pagination<T> {
  current_page: number;
  data: T[];
  first_page_url: string;
  from: number;
  last_page: number;
  last_page_url: string;
  links: Array<Link>;
  next_page_url: string;
  path: string;
  per_page: number;
  prev_page_url: string;
  to: number;
  total: number;
}

export interface Media {
  id: number;
  uuid: string;
  name: string;
  file_name: string;
  mime_type: string;
  size: number;
  disk: string;
  collection_name: string;
  conversions_disk: string;
  custom_properties: [];
  generated_conversions: [];
  manipulations: [];
  model_id: number;
  model_type: string;
  order_column: 1;
  original_url: string;
  preview_url: string;
  responsive_images: [];
  created_at: string;
  updated_at: string;
}

export interface Link {
  url: string | null;
  label: string;
  active: boolean;
}

export interface PaginationProps<T> {
  data: T[];
  links: {
    first: string;
    last: string;
    prev: string;
    next: string;
  };
  meta: {
    current_page: number;
    last_page: number;
    links: Array<Link>;
    from: number;
    to: number;
    total: number;
  };
}

export type PageProps<
  T extends Record<string, unknown> = Record<string, unknown>,
> = T & {
  auth: {
    user: User;
  };
  flash: {
    message: string;
    status: "Success" | "Error" | "Warning" | "Info" | null;
  };
  breadcrumbs: string;
};
