    <side-bar base-url="<?=$this->request->getAttribute('base')?>/asgard" title=" Shards Dashboard" 
    :items="[
        {
            title: 'dashboard',
            children: [
                {
                    title: 'Dashboard',
                    icon: 'dashboard',
                    url: '/dashboard'
                },
                {
                    title: 'Admins',
                    icon: 'people',
                    url: '/admins'
                },
                {
                    title: 'Abouts',
                    icon: 'apps',
                    url: '/abouts'
                },
                {
                    title: 'Blogs',
                    icon: 'article',
                    url: '/blogs'
                },
                {
                    title: 'Projects',
                    icon: 'task',
                    url: '/projects'
                }
            
            ]
        }
    ]">
    </side-bar>