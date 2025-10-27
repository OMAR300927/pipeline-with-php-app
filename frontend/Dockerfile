FROM nginx

# نحذف الصفحة الافتراضية (اختياري لكنه جيد)
RUN rm -rf /usr/share/nginx/html/*

COPY . /usr/share/nginx/html/

# 👇 نعدّل صلاحيات الملفات حتى يستطيع Nginx قراءتها
RUN chmod -R 755 /usr/share/nginx/html && \
    chown -R nginx:nginx /usr/share/nginx/html

EXPOSE 80